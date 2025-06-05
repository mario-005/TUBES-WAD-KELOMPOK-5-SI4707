<div class="mb-3">
    <label>Nama Rumah Makan</label>
    <input type="text" name="nama_rumah_makan" class="form-control" value="{{ old('nama_rumah_makan', $ulasan->nama_rumah_makan ?? '') }}">
</div>

<div class="mb-3">
    <label>Nama Pengulas</label>
    <input type="text" name="nama_pengulas" class="form-control" value="{{ old('nama_pengulas', $ulasan->nama_pengulas ?? '') }}">
</div>

<div class="mb-3">
    <label>Rating (1-5)</label>
    <input type="number" name="rating" min="1" max="5" class="form-control" value="{{ old('rating', $ulasan->rating ?? '') }}">
</div>

<div class="mb-3">
    <label>Komentar</label>
    <textarea name="komentar" class="form-control">{{ old('komentar', $ulasan->komentar ?? '') }}</textarea>
</div>

<button type="submit" class="btn btn-success">Simpan</button>
