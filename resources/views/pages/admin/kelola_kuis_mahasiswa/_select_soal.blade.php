<select name="nama_soal" class="form-control @error("nama_soal") {{ 'is-invalid' }} @enderror " id="nama_soal">
    <option value="">- Pilih -</option>
    @foreach ($detail as $item)
        <option value="{{ $item["slug"] }}" {{ $nama_soal == $item["slug"] ? 'selected' : '' }} >
            {{ $item["nama_soal"] }}
        </option>
    @endforeach
</select>
