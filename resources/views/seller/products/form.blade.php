<div class="form-grid">
    <div class="form-group full">
        <label>Nama/Judul Produk</label>
        <input type="text" name="title" value="{{ old('title', $product->title ?? '') }}" required>
    </div>

    <div class="form-group full">
        <label>Deskripsi</label>
        <textarea name="description" rows="6" required>{{ old('description', $product->description ?? '') }}</textarea>
    </div>

    <div class="form-group">
        <label>Harga</label>
        <input type="number" name="price" min="0" step="1000" value="{{ old('price', $product->price ?? '') }}" required>
    </div>

    <div class="form-group">
        <label>Level</label>
        <input type="number" name="level" min="0" value="{{ old('level', $product->level ?? '') }}">
    </div>

    <div class="form-group">
        <label>Rank</label>
        <input type="text" name="rank" value="{{ old('rank', $product->rank ?? '') }}">
    </div>

    <div class="form-group">
        <label>Jumlah Skin</label>
        <input type="number" name="skin_count" min="0" value="{{ old('skin_count', $product->skin_count ?? '') }}">
    </div>

    <div class="form-group">
        <label>Server</label>
        <input type="text" name="server" value="{{ old('server', $product->server ?? '') }}" placeholder="Contoh: Asia">
    </div>

    @isset($product)
    <div class="form-group">
        <label>Status</label>
        <select name="status" required>
            @foreach(['active', 'inactive', 'sold'] as $status)
                <option value="{{ $status }}" @selected(old('status', $product->status) === $status)>
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>
    </div>
    @endisset
</div>
