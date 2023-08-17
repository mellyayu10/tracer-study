<!-- Modal Edit -->
@foreach ($instansi as $item)
<div class="modal fade bs-example-modal-center-edit-{{ $item["id"] }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    <i class="fa fa-plus"></i> Edit Data
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <form action="{{ url('/admin/instansi/'.$item['id']) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_instansi"> Nama Instansi </label>
                        <input type="text" class="form-control @error("nama_instansi") {{ 'is-invalid' }} @enderror " name="nama_instansi" id="nama_instansi" placeholder="Masukkan Nama Instansi" value="{{ old("nama_instansi", $item['nama_instansi']) }}">
                    </div>
                    @error("nama_instansi")
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror

                    <br>
                    
                    <div class="form-group">
                        <label for="provinsi"> Provinsi </label>
                        <select name="provinsi" class="form-control @error("provinsi") {{ 'is-invalid' }} @enderror " id="provinsi">
                            <option value="">- Pilih -</option>
                            @foreach ($provinsi as $p)
                                <option {{ $p['name']==$item['provinsi']?'selected':'' }} value="{{ $p["name"] }}">
                                    {{ $p["name"] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @error("provinsi")
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror

                    <br>
                    
                    <div class="form-group">
                        <label for="kota_kab"> Kota Kabupaten </label>
                        <select name="kota_kab" class="form-control @error("kota_kab") {{ 'is-invalid' }} @enderror " id="kota_kab">
                            <option value="">- Pilih Kota Kabupaten -</option>
                            <option selected value="{{ $item["kota_kab"] }}">
                                {{ $item["kota_kab"] }}
                            </option>
                        </select>
                    </div>
                    
                    @error("kota_kab")
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror

                    <br>
                    
                    <div class="form-group">
                        <label for="kecamatan"> Kecamatan </label>
                        <select name="kecamatan" class="form-control @error("kecamatan") {{ 'is-invalid' }} @enderror " id="kecamatan">
                            <option value="">- Pilih Kecamatan -</option>
                            <option selected value="{{ $item["kecamatan"] }}">
                                {{ $item["kecamatan"] }}
                            </option>
                        </select>
                    </div>
                    
                    @error("kecamatan")
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror

                    <br>
                    
                    <div class="form-group">
                        <label for="kelurahan"> Kelurahan </label>
                        <select name="kelurahan" class="form-control @error("kelurahan") {{ 'is-invalid' }} @enderror " id="kelurahan">
                            <option value="">- Pilih Kelurahan -</option>
                            <option selected value="{{ $item["kelurahan"] }}">
                                {{ $item["kelurahan"] }}
                            </option>
                        </select>
                    </div>
                    
                    @error("kelurahan")
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror

                    <br>
                    
                    <div class="form-group">
                        <label for="alamat"> Alamat </label>
                        <textarea class="form-control" id="alamat"  rows="5" placeholder="Masukkan Alamat">{{ old('alamat', $item['alamat']) }}</textarea>
                    </div>
                    
                    @error("alamat")
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-danger btn-sm">
                        <i class="fa fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<!-- END -->