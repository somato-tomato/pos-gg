<form method="post" action="{{ route('test') }}">
    @csrf
    <label for="jumlah">id barang</label>
    <input name="id_barang">
    <label for="jumlah">jumlah</label>
    <input name="jumlah">
    <button type="submit">cek</button>
</form>
