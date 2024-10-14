<form action="{{ route('event.ruangan.update', $ruangan->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label for="nama_ruangan">Nama Ruangan:</label>
    <input type="text" name="nama_ruangan" value="{{ $ruangan->nama_ruangan }}" required>

    <label for="lantai">Lokasi:</label>
    <input type="text" name="lantai" value="{{ $ruangan->lantai }}" required>

    <label for="biaya_sewa">Biaya Sewa:</label>
    <input type="text" name="biaya_sewa" value="{{ $ruangan->biaya_sewa }}" required>

    <label for="gambar">Ganti Gambar:</label>
    <input type="file" name="gambar">

    <button type="submit">Update</button>
</form>
