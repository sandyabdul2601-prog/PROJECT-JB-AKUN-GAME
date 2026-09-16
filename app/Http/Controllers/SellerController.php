<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Wallet;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SellerController extends Controller
{
    private function sellerId(): int
    {
        return (int) Auth::id();
    }

    public function dashboard()
    {
        $sellerId = $this->sellerId();

        $productCount = Product::where('seller_id', $sellerId)->count();
        $activeProductCount = Product::where('seller_id', $sellerId)
            ->where('status', 'active')->count();

        $orderCount = Order::where('seller_id', $sellerId)->count();
        $pendingOrderCount = Order::where('seller_id', $sellerId)
            ->whereIn('status', ['pending', 'waiting_payment', 'payment_received', 'waiting_account', 'checking'])
            ->count();

        $wallet = Wallet::firstOrCreate(
            ['user_id' => $sellerId],
            ['balance' => 0]
        );

        $recentOrders = Order::with('product')
            ->where('seller_id', $sellerId)
            ->latest()
            ->take(5)
            ->get();

        return view('seller.dashboard', compact(
            'productCount',
            'activeProductCount',
            'orderCount',
            'pendingOrderCount',
            'wallet',
            'recentOrders'
        ));
    }

    public function products(Request $request)
    {
        $query = Product::where('seller_id', $this->sellerId())
            ->latest();

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($builder) use ($q) {
                $builder->where('title', 'like', "%{$q}%")
                    ->orWhere('server', 'like', "%{$q}%")
                    ->orWhere('rank', 'like', "%{$q}%");
            });
        }

        $products = $query->paginate(10)->withQueryString();

        return view('seller.products.index', compact('products'));
    }

    public function createProduct()
    {
        return view('seller.products.create');
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'level' => ['nullable', 'integer', 'min:0'],
            'rank' => ['nullable', 'string', 'max:100'],
            'skin_count' => ['nullable', 'integer', 'min:0'],
            'server' => ['nullable', 'string', 'max:100'],
        ]);

        $validated['seller_id'] = $this->sellerId();
        $validated['status'] = 'active';

        Product::create($validated);

        return redirect()
            ->route('seller.products')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function editProduct(Product $product)
    {
        $this->ensureOwner($product);

        return view('seller.products.edit', compact('product'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        $this->ensureOwner($product);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'level' => ['nullable', 'integer', 'min:0'],
            'rank' => ['nullable', 'string', 'max:100'],
            'skin_count' => ['nullable', 'integer', 'min:0'],
            'server' => ['nullable', 'string', 'max:100'],
            'status' => ['required', 'in:active,inactive,sold'],
        ]);

        $product->update($validated);

        return redirect()
            ->route('seller.products')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroyProduct(Product $product)
    {
        $this->ensureOwner($product);

        if ($product->orders()->exists()) {
            return back()->with('error', 'Produk tidak dapat dihapus karena sudah memiliki pesanan. Nonaktifkan produk saja.');
        }

        $product->delete();

        return redirect()
            ->route('seller.products')
            ->with('success', 'Produk berhasil dihapus.');
    }

    public function orders(Request $request)
    {
        $query = Order::with(['product', 'buyer'])
            ->where('seller_id', $this->sellerId())
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(10)->withQueryString();

        return view('seller.orders.index', compact('orders'));
    }

    public function showOrder(Order $order)
    {
        $this->ensureOrderOwner($order);

        $order->load(['product', 'buyer']);

        return view('seller.orders.show', compact('order'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $this->ensureOrderOwner($order);

        $validated = $request->validate([
            'status' => ['required', 'in:waiting_account,account_received,checking,completed,cancelled'],
        ]);

        $order->update(['status' => $validated['status']]);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function wallet()
    {
        $wallet = Wallet::firstOrCreate(
            ['user_id' => $this->sellerId()],
            ['balance' => 0]
        );

        $withdrawals = Withdrawal::where('user_id', $this->sellerId())
            ->latest()
            ->paginate(10);

        $completedSales = Order::where('seller_id', $this->sellerId())
            ->where('status', 'completed')
            ->sum('seller_amount');

        return view('seller.wallet.index', compact(
            'wallet',
            'withdrawals',
            'completedSales'
        ));
    }

    public function withdrawal(Request $request)
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:10000'],
            'method' => ['required', 'string', 'max:50'],
            'account_number' => ['required', 'string', 'max:100'],
            'account_name' => ['required', 'string', 'max:100'],
        ]);

        $wallet = Wallet::firstOrCreate(
            ['user_id' => $this->sellerId()],
            ['balance' => 0]
        );

        if ((float) $validated['amount'] > (float) $wallet->balance) {
            return back()
                ->withInput()
                ->with('error', 'Saldo tidak mencukupi.');
        }

        DB::transaction(function () use ($validated, $wallet) {
            $wallet->decrement('balance', $validated['amount']);

            Withdrawal::create([
                'user_id' => $this->sellerId(),
                'amount' => $validated['amount'],
                'method' => $validated['method'],
                'account_number' => $validated['account_number'],
                'account_name' => $validated['account_name'],
                'status' => 'pending',
            ]);
        });

        return redirect()
            ->route('seller.wallet')
            ->with('success', 'Pengajuan penarikan berhasil dibuat.');
    }

    private function ensureOwner(Product $product): void
    {
        abort_unless($product->seller_id === $this->sellerId(), 403);
    }

    private function ensureOrderOwner(Order $order): void
    {
        abort_unless($order->seller_id === $this->sellerId(), 403);
    }
}
