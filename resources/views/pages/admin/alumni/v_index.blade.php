@extends("pages.layouts.main")

@section("title", "Data Alumni")

@section("css")

<link href="{{ url('') }}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('') }}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('') }}/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('') }}/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

@endsection

@section("content")

<div class="container-fluid">
    
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">
                    @yield("title")
                </h4>
                
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/admin/dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Alumni
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    @if (session("message"))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-all me-2"></i>
        {!! session("message") !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert"
        aria-label="Close"></button>
    </div>
    @endif

    @if (session("error"))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-all me-2"></i>
        {!! session("error") !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert"
        aria-label="Close"></button>
    </div>
    @endif
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center">
                        <i class="fa fa-plus"></i> Tambah Data
                    </button>
                    <br><br>
                    <table id="datatable" class="table table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">NIM</th>
                                <th>Nama</th>
                                <th class="text-center">Prodi</th>
                                <th class="text-center">Tahun Masuk</th>
                                <th class="text-center">Tahun Lulus</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $nomer = 0
                            @endphp
                            @foreach ($alumni as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}.</td>
                                <td class="text-center">{{ $item["nim"] }}</td>
                                <td>{{ $item["user"]["nama"] }}</td>
                                <td class="text-center">{{ $item["prodi"]["nama_prodi"] }}</td>
                                <td class="text-center">
                                    @if ($item["bulan_masuk"] == 1)
                                        Januari
                                    @elseif($item["bulan_masuk"] == 2)
                                        Februari
                                    @elseif($item["bulan_masuk"] == 3)
                                        Maret
                                    @elseif($item["bulan_masuk"] == 4)
                                        April
                                    @elseif($item["bulan_masuk"] == 5)
                                        Mei
                                    @elseif($item["bulan_masuk"] == 6)
                                        Juni
                                    @elseif($item["bulan_masuk"] == 7)
                                        Juli
                                    @elseif($item["bulan_masuk"] == 8)
                                        Agustus
                                    @elseif($item["bulan_masuk"] == 9)
                                        September
                                    @elseif($item["bulan_masuk"] == 10)
                                        Oktober
                                    @elseif($item["bulan_masuk"] == 11)
                                        November
                                    @elseif($item["bulan_masuk"] == 12)
                                        Desember
                                    @endif
                                    {{ $item["tahun_masuk"] }}
                                </td>
                                <td class="text-center">
                                    @if ($item["bulan_lulus"] == 1)
                                        Januari
                                    @elseif($item["bulan_lulus"] == 2)
                                        Februari
                                    @elseif($item["bulan_lulus"] == 3)
                                        Maret
                                    @elseif($item["bulan_lulus"] == 4)
                                        April
                                    @elseif($item["bulan_lulus"] == 5)
                                        Mei
                                    @elseif($item["bulan_lulus"] == 6)
                                        Juni
                                    @elseif($item["bulan_lulus"] == 7)
                                        Juli
                                    @elseif($item["bulan_lulus"] == 8)
                                        Agustus
                                    @elseif($item["bulan_lulus"] == 9)
                                        September
                                    @elseif($item["bulan_lulus"] == 10)
                                        Oktober
                                    @elseif($item["bulan_lulus"] == 11)
                                        November
                                    @elseif($item["bulan_lulus"] == 12)
                                        Desember
                                    @endif
                                    {{ $item["tahun_lulus"] }}
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-warning btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center-edit-{{ $item["id"] }}">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                    <form action="{{ url('/admin/data_alumni/'.$item['id']) }}" method="POST" style="display: inline">
                                        @csrf
                                        @method("DELETE")
                                        <button onclick="return confirm('Yakin ? Anda Ingin Menghapus Data Ini ?')" type="submit" class="btn btn-danger btn-sm waves-effect waves-light">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                    <a href="{{ url('/admin/data_alumni/'.$item["id"]) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-search"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambah Data -->
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    <i class="fa fa-plus"></i> Tambah Data
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <form action="{{ url('/admin/data_alumni') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama"> Nama </label>
                        <input type="text" class="form-control @error("nama") {{ 'is-invalid' }} @enderror " name="nama" id="nama" placeholder="Masukkan Nama" value="{{ old('nama') }}">
                    </div>
                    @error("nama")
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                    @enderror
                    <br>
                    <div class="form-group">
                        <label for="email"> Email </label>
                        <input type="email" class="form-control @error("email") {{ 'is-invalid' }} @enderror " name="email" id="email" placeholder="Masukkan Email" value="{{ old('email') }}">
                    </div>
                    @error("email")
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                    @enderror
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nomor_hp"> Nomor HP </label>
                                <input type="text" class="form-control @error("nomor_hp") {{ 'is-invalid' }} @enderror " name="nomor_hp" id="nomor_hp" placeholder="0" value="{{ old('nomor_hp') }}">
                            </div>
                            @error("nomor_hp")
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="prodi_id"> Prodi </label>
                                <select name="prodi_id" class="form-control @error("prodi_id") {{ 'is-invalid' }} @enderror " id="prodi_id">
                                    <option value="">- Pilih -</option>
                                    @foreach ($prodi as $item)
                                    <option value="{{ $item["id"] }}" {{ old('prodi_id') == $item["id"] ? 'selected' : '' }} >
                                        {{ $item["nama_prodi"] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @error("prodi_id")
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nim"> NIM </label>
                                <input type="text" class="form-control @error("nim") {{ 'is-invalid' }} @enderror" name="nim" id="nim" placeholder="0" value="{{ old('nim') }}">
                            </div>
                            @error("nim")
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_kelamin"> Jenis Kelamin </label>
                                <select name="jenis_kelamin" class="form-control @error("jenis_kelamin") {{ 'is-invalid' }} @enderror " id="jenis_kelamin">
                                    <option value="">- Pilih -</option>
                                    <option value="L" {{ old('jenis_kelamin') == "L" ? 'selected' : '' }} >Laki - Laki</option>
                                    <option value="P" {{ old('jenis_kelamin') == "P" ? 'selected' : '' }} >Perempuan</option>
                                </select>
                            </div>
                            @error("jenis_kelamin")
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tahun_masuk"> Tahun Masuk </label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select name="bulan_masuk" class="form-control @error("bulan_masuk") {{ 'is-invalid' }} @enderror" id="bulan_masuk">
                                            <option value="">- Pilih -</option>
                                            @foreach ($bulan as $item => $label)
                                            <option value="{{ $item }}" {{ old('bulan_masuk') == $item ? 'selected' : '' }} >
                                                {{ $label }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error("bulan_masuk")
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <input type="year" class="form-control @error("tahun_masuk") {{ 'is-invalid' }} @enderror " name="tahun_masuk" id="tahun_masuk" placeholder="0" value="{{ old('tahun_masuk') }}">
                                        @error("tahun_masuk")
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tahun_lulus"> Tahun Lulus </label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select name="bulan_lulus" class="form-control @error("bulan_lulus") {{ 'is-invalid' }} @enderror" id="bulan_lulus">
                                            <option value="">- Pilih -</option>
                                            @foreach ($bulan as $item => $label)
                                            <option value="{{ $item }}" {{ old('bulan_lulus') == $item ? 'selected' : '' }} >
                                                {{ $label }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error("bulan_lulus")
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <input type="year" class="form-control @error("tahun_lulus") {{ 'is-invalid' }} @enderror " name="tahun_lulus" id="tahun_lulus" placeholder="0" value="{{ old('tahun_lulus') }}">
                                        @error("tahun_lulus")
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="tanggal_lahir"> Tanggal Lahir </label>
                        <input type="date" class="form-control @error("tanggal_lahir") {{ 'is-invalid' }} @enderror" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                    </div>
                    @error("tanggal_lahir")
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                    @enderror
                    <br>
                    <div class="form-group">
                        <label for="foto"> Foto </label>
                        <input type="file" class="form-control @error("foto") {{ 'is-invalid' }} @enderror " name="foto" id="foto" value="{{ old('foto') }}">
                    </div>
                    @error("foto")
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                    @enderror
                    <br>
                    <div class="form-group">
                        <label for="alamat"> Alamat </label>
                        <textarea name="alamat" class="form-control @error("alamat") {{ 'is-invalid' }} @enderror" id="alamat" rows="5" placeholder="Masukkan Alamat">{{ old('alamat') }}</textarea>
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
<!-- END -->

<!-- Edit Data -->
@foreach ($alumni as $item)
<div class="modal fade bs-example-modal-center-edit-{{ $item['id'] }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    <i class="fa fa-edit"></i> Edit Data
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <form action="{{ url('/admin/data_alumni/'.$item["id"]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <input type="hidden" name="foto_lama" value="{{ $item["foto"] }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama"> Nama </label>
                        <input type="text" class="form-control @error("nama") {{ 'is-invalid' }} @enderror " name="nama" id="nama" placeholder="Masukkan Nama" value="{{ old('nama') ?? $item["user"]["nama"] ?? '' }}">
                    </div>
                    @error("nama")
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                    @enderror
                    <br>
                    <div class="form-group">
                        <label for="email"> Email </label>
                        <input type="email" class="form-control @error("email") {{ 'is-invalid' }} @enderror " name="email" id="email" placeholder="Masukkan Email" value="{{ old('email') ?? $item["user"]["email"] ?? '' }}">
                    </div>
                    @error("email")
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                    @enderror
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nomor_hp"> Nomor HP </label>
                                <input type="text" class="form-control @error("nomor_hp") {{ 'is-invalid' }} @enderror " name="nomor_hp" id="nomor_hp" placeholder="0" value="{{ old('nomor_hp') ?? $item["user"]["nomor_hp"] ?? '' }}">
                            </div>
                            @error("nomor_hp")
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="prodi_id"> Prodi </label>
                                <select name="prodi_id" class="form-control @error("prodi_id") {{ 'is-invalid' }} @enderror " id="prodi_id">
                                    <option value="">- Pilih -</option>
                                    @foreach ($prodi as $edit)
                                    @if ($edit->id == $item->prodi_id)
                                    <option value="{{ $edit["id"] }}" {{ ($edit["id"] == $item["prodi_id"]) ? 'selected' : '' }} >
                                        {{ $edit["nama_prodi"] }}
                                    </option>
                                    @else
                                    <option value="{{ $edit["id"] }}">
                                        {{ $edit["nama_prodi"] }}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            @error("prodi_id")
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nim"> NIM </label>
                                <input type="text" class="form-control @error("nim") {{ 'is-invalid' }}  @enderror " name="nim" id="nim" placeholder="0" value="{{ old('nim') ?? $item["nim"] ?? '' }}">
                            </div>
                            @error("nim")
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_kelamin"> Jenis Kelamin </label>
                                <select name="jenis_kelamin" class="form-control @error("jenis_kelamin") {{ 'is-invalid' }} @enderror " id="jenis_kelamin">
                                    <option value="">- Pilih -</option>
                                    @if (old('jenis_kelamin') || $item['jenis_kelamin'] === "L")
                                    <option value="L" selected>Laki - Laki</option>
                                    <option value="P">Perempuan</option>
                                    @elseif(old('jenis_kelamin') || $item['jenis_kelamin'] === "P")
                                    <option value="L">Laki - Laki</option>
                                    <option value="P" selected>Perempuan</option>
                                    @else
                                    <option value="L">Laki - Laki</option>
                                    <option value="P">Perempuan</option>
                                    @endif
                                </select>
                            </div>
                            @error("jenis_kelamin")
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tahun_masuk"> Tahun Masuk </label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select name="bulan_masuk" class="form-control @error("bulan_masuk") {{ 'is-invalid' }} @enderror" id="bulan_masuk">
                                            <option value="">- Pilih -</option>
                                            @foreach ($bulan as $index => $label)
                                            <option disabled value="{{ $index }}" {{ old('bulan_masuk') || $item['bulan_masuk'] == $index ? 'selected' : '' }} >
                                                {{ $label }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error("bulan_masuk")
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <input type="year" class="form-control @error("tahun_masuk") {{ 'is-invalid' }} @enderror " name="tahun_masuk" id="tahun_masuk" placeholder="0" value="{{ $item["tahun_masuk"] }}" readonly>
                                        @error("tahun_masuk")
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tahun_lulus"> Tahun Lulus </label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select name="bulan_lulus" class="form-control @error("bulan_lulus") {{ 'is-invalid' }} @enderror" id="bulan_lulus">
                                            <option value="">- Pilih -</option>
                                            @foreach ($bulan as $index => $label)
                                            <option disabled value="{{ $index }}" {{ old('bulan_lulus') || $item['bulan_lulus'] == $index ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error("bulan_lulus")
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <input type="year" class="form-control @error("tahun_lulus") {{ 'is-invalid' }} @enderror " name="tahun_lulus" id="tahun_lulus" placeholder="0" value="{{ old('tahun_lulus') ?? $item["tahun_lulus"] ?? '' }}" readonly>
                                        @error("tahun_lulus")
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="tanggal_lahir"> Tanggal Lahir </label>
                        <input type="date" class="form-control @error("tanggal_lahir") {{ 'is-invalid' }} @enderror" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') ?? $item["tanggal_lahir"] ?? ''  }}">
                    </div>
                    @error("tanggal_lahir")
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                    @enderror
                    <br>
                    <div class="form-group">
                        <label for="foto"> Foto </label>
                        <input type="file" class="form-control @error("foto") {{ 'is-invalid' }} @enderror " name="foto" id="foto" value="{{ old('foto') }}">
                    </div>
                    @error('foto')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                    @enderror
                    <br>
                    <div class="form-group">
                        <label for="alamat"> Alamat </label>
                        <textarea name="alamat" class="form-control @error("alamat") {{ 'is-invalid' }} @enderror" id="alamat" rows="5" placeholder="Masukkan Alamat">{{ old('alamat') ?? $item["alamat"] ?? '' }}</textarea>
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

@endsection

@section("javascript")

<script src="{{ url('') }}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ url('') }}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ url('') }}/assets/js/pages/datatables.init.js"></script>

@endsection
