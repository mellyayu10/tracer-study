@php
use Carbon\Carbon;
use App\Models\KuisMahasiswa;
use App\Models\KuisPenggunaAlumni;
use App\Models\DetailKategoriKuisioner;
use App\Models\PointPilihanTunggal;
use App\Models\PointPilihanGanda;
@endphp

@extends("pages.layouts.main")

@section("css")

<link href="{{ url('') }}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('') }}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('') }}/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('') }}/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<style type="text/css">
    .tt-menu{
        background-color: rgb(255, 255, 255);
        width: 100%;
        border: 1px solid #d4d4d4;
    }
    .twitter-typeahead{
        display: block !important;
        width: 100%;
    }
    .tt-suggestion{
        padding: 10px;
        cursor: pointer;
        background-color: #fff;
        border-bottom: 1px solid #d4d4d4;
    }
</style>

@endsection

@section("title", "Dashboard Alumni")

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
                        <li class="breadcrumb-item active">
                            Dashboard
                        </li>
                    </ol>
                </div>
                
            </div>
        </div>
    </div>
    
    @if (session("success"))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-all me-2"></i>
        {!! session("success") !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert"
        aria-label="Close"></button>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success mb-0" role="alert">
                <h5 class="alert-heading font-size-16">
                    Selamat Datang
                    <strong>
                        {{ Auth::user()->nama }}
                    </strong>
                    !
                </h5>
                <p>
                    Anda Login Sebagai <strong style="color: blue">Alumni</strong>
                    <strong>
                        Aplikasi Study Tracer
                    </strong>
                </p>
                <hr>
                <p class="mb-0">
                    Silahkan Pilih Menu Untuk Melanjutkan Program.
                </p>
            </div>
        </div>
    </div>
    <br>
    @endif
    
    @if (session("message"))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-all me-2"></i>
        {!! session("message") !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert"
        aria-label="Close"></button>
    </div>
    @endif
    
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success mb-0" role="alert">
                <p class="mb-0">
                    <strong>
                        Note :
                    </strong>
                    <br>
                    <ul>
                        <li>Menu Pekerjaan Untuk Alumni Yang <strong>Sudah</strong> Punya Pekerjaan</li>
                        <li>Menu Kuisoner Untuk Alumni Yang <strong>Belum</strong> Punya Pekerjaan</li>
                    </ul>
                </p>
            </div>
        </div>
    </div>
    <br>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    Profil Alumni
                </h4>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#profil_diri" role="tab">
                            <span class="d-block d-sm-none">
                                <i class="fas fa-home"></i>
                            </span>
                            <span class="d-none d-sm-block">Data Diri</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#riwayat" role="tab">
                            <span class="d-block d-sm-none">
                                <i class="far fa-user"></i>
                            </span>
                            <span class="d-none d-sm-block">Pekerjaan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#kuisioner" role="tab">
                            <span class="d-block d-sm-none">
                                <i class="far fa-user"></i>
                            </span>
                            <span class="d-none d-sm-block">Kuisioner</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane active" id="profil_diri" role="tabpanel">
                        <form action="{{ url('/alumni/update_profil') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="row mb-3">
                                <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                                <div class="col-sm-7">
                                    <input class="form-control" type="text" placeholder="NIM Anda" id="nim" value="{{ Auth::user()->alumni->nim }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-7">
                                    <input class="form-control" type="text" placeholder="Nama Lengkap" id="nama" value="{{ Auth::user()->nama }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tahun_masuk" class="col-sm-2 col-form-label">Tahun Masuk</label>
                                <div class="col-sm-7">
                                    <input class="form-control" type="text" placeholder="Tahun Masuk" id="tahun_masuk" value="{{ Auth::user()->alumni->tahun_masuk }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tahun_lulus" class="col-sm-2 col-form-label">Tahun Lulus</label>
                                <div class="col-sm-7">
                                    <input class="form-control" type="text" placeholder="Tahun Lulus" id="tahun_lulus" value="{{ Auth::user()->alumni->tahun_lulus }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-7">
                                    <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                                        <option value="">- Pilih -</option>
                                        @if (Auth::user()->alumni->jenis_kelamin == "L")
                                        <option value="L" selected>Laki - Laki</option>  
                                        <option value="P">Perempuan</option>  
                                        @elseif(Auth::user()->alumni->jenis_kelamin == "P")
                                        <option value="L">Laki - Laki</option>  
                                        <option value="P" selected>Perempuan</option>  
                                        @else
                                        <option value="L">Laki - Laki</option>  
                                        <option value="P">Perempuan</option>  
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nomor_hp" class="col-sm-2 col-form-label"> Nomor HP </label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control @error("nomor_hp") {{ 'is-invalid' }} @enderror" name="nomor_hp" id="nomor_hp" placeholder="Masukkan Nomor HP" value="{{ old('nomor_hp') ?? Auth::user()->nomor_hp ?? '' }}">
                                    @error("nomor_hp")
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tanggal_lahir" class="col-sm-2 col-form-label"> Tanggal Lahir </label>
                                <div class="col-sm-7">
                                    <input type="date" class="form-control @error("tanggal_lahir") {{ 'is-invalid' }} @enderror" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') ?? Auth::user()->alumni->tanggal_lahir ?? '' }}">
                                    @error("tanggal_lahir")
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="provinsi" class="col-sm-2 col-form-label"> Provinsi </label>
                                <div class="col-sm-7">
                                    <select name="provinsi" class="form-control @error("provinsi") {{ 'is-invalid' }} @enderror" id="provinsi">
                                        <option value="">- Pilih -</option>
                                        @foreach ($provinsi as $item)
                                            <option value="{{ $item['id'] }}" {{ $item["name"] == Auth::user()->alumni->provinsi ? 'selected' : '' }} >
                                                {{ $item["name"] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error("provinsi")
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="kota_kab" class="col-sm-2 col-form-label"> Kota Kabupaten </label>
                                <div class="col-sm-7">
                                    <select name="kota_kab" class="form-control @error("kota_kab") {{ 'is-invalid' }} @enderror" id="kota_kab">
                                        @if (!empty(Auth::user()->alumni->kota_kab))
                                            <option value="" selected disabled>
                                                {{ Auth::user()->alumni->kota_kab }}
                                            </option>
                                        @else
                                        <option value="">- Pilih -</option>
                                        @endif
                                    </select>
                                    @error("kota_kab")
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="kecamatan" class="col-sm-2 col-form-label"> Kecamatan </label>
                                <div class="col-sm-7">
                                    <select name="kecamatan" class="form-control @error("kecamatan") {{ 'is-invalid' }} @enderror" id="kecamatan">
                                        @if (!empty(Auth::user()->alumni->kecamatan))
                                        <option value="" disabled selected>
                                            {{ Auth::user()->alumni->kecamatan }}
                                        </option>
                                        @else
                                        <option value="">- Pilih Kecamatan -</option>
                                        @endif
                                    </select>
                                    @error("kecamatan")
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="kelurahan" class="col-sm-2 col-form-label"> Kelurahan </label>
                                <div class="col-sm-7">
                                    <select name="kelurahan" class="form-control @error("kelurahan") {{ 'is-invalid' }} @enderror" id="kelurahan">
                                        @if (!empty(Auth::user()->alumni->kelurahan))
                                            <option value="" disabled selected>
                                                {{ Auth::user()->alumni->kelurahan }}
                                            </option>
                                        @else
                                        <option value="">- Pilih Kelurahan -</option>
                                        @endif
                                    </select>
                                    @error("kelurahan")
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="alamat" class="col-sm-2 col-form-label"> Alamat </label>
                                <div class="col-sm-7">
                                    <textarea name="alamat" class="form-control" id="alamat" rows="5" placeholder="Masukkan Alamat">{{ old('alamat') ?? Auth::user()->alumni->alamat ?? '' }}</textarea>
                                    @error("alamat")
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="foto" class="col-sm-2 col-form-label"> Foto </label>
                                <div class="col-sm-7">
                                    @if (empty(Auth::user()->alumni->foto))
                                    <img src="{{ url('/assets/images/users/avatar-2.jpg') }}" style="width: 100; height: 100">
                                    @else
                                    <img src="{{ url('/storage/'.Auth::user()->alumni->foto) }}" style="width: 300px; height: 100">
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="ganti_gambar" class="col-sm-2 col-form-label"> Ganti Gambar </label>
                                <div class="col-sm-7">
                                    <input type="hidden" name="foto_lama" value="{{ Auth::user()->alumni->foto }}">
                                    <input type="file" class="form-control" name="foto" id="ganti_gambar">
                                </div>
                            </div>
                            <div class="row mb-3">
                            <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-danger btn-sm">
                        <i class="fa fa-times"></i> Batal
                    </button>
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-save"></i> Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="riwayat" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">
                                    <i class="fa fa-plus"></i> Tambah
                                </button>
                                <br><br>
                                <table id="datatable" class="table table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th>Instansi</th>
                                            <th class="text-center">Profesi</th>
                                            <th class="text-center">WhatsApp</th>
                                            <th class="text-center">Tahun Masuk</th>
                                            <th class="text-center">Tahun Akhir</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($riwayat as $item)
                                        @php
                                        $cek = KuisMahasiswa::where("pekerjaan_id", $item["id"])->first();
                                        @endphp
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}.</td>
                                            <td>{{ $item["nama_instansi"] }}</td>
                                            <td class="text-center">{{ $item["profesi"] }}</td>
                                            <td class="text-center">
                                                @if ($item["is_kuisioner"] == 0)
                                                <a target="_blank" href="{{ url('/link/'.$item["id"]) }}">
                                                    <i class="fa fa-phone"></i>
                                                </a>
                                                @else
                                                <span class="text-success">
                                                    Sudah Mengisi    
                                                </span>   
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $item["periode_kerja_mulai"] }} </td>
                                            <td class="text-center">{{ $item["periode_kerja_akhir"] }}</td>
                                            <td class="text-center">
                                                @if ($cek)
                                                
                                                @else
                                                <a href="{{ url('/alumni/kuis_mahasiswa/create/'.$item["id"]) }}" class="btn btn-primary btn-sm waves-effect">
                                                    <i class="fa fa-plus"></i> Isi Kuisioner
                                                </a>
                                                
                                                @endif
                                                <button type="button" class="btn btn-warning btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg-edit-{{ $item["id"] }}">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-info btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg-detail-{{ $item["id"] }}">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                                <form action="{{ url('/alumni/riwayat_pekerjaan/'.$item["id"]) }}" method="POST" style="display: inline">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button onclick="return confirm('Yakin ? Apakah Anda Ingin Menghapus Data Ini ?')" type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="kuisioner" role="tabpanel">
                        <div class="card">
                            <form action="{{ url('/alumni/kuis_mahasiswa/store/status/belum') }}" method="POST">
                                @csrf
                                <input type="hidden" name="alumni_id" value="{{ Auth::user()->alumni->id }}">
                                <div class="card-body">
                                    @foreach ($kategori_kuisioner as $item)
                                    @php
                                    $detail = DetailKategoriKuisioner::where("kategori_kuisioner_id", $item["id"])->where("is_kuisioner", "1")->get();
                                    @endphp
                                    <h4 class="card-title">
                                        {{ $item["nama_kategori_kuisioner"] }}
                                    </h4>
                                    <hr>
                                    @foreach ($detail as $data)
                                    @if ($data["tipe_soal"] == 1)
                                    <div class="form-group mt-1 mb-2">
                                        <label class="form-label"> {{ $data["nama_soal"] }} </label>
                                        <input type="text" class="form-control @error($data["slug"]) {{ 'is-invalid' }} @enderror " name={{ $data["slug"] }} placeholder="Silahkan Diisi" value="{{ old($data["slug"]) }}" >
                                    </div>
                                    @error($data["slug"])
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    @elseif($data["tipe_soal"] == 2)
                                    @php
                                    $data_point = PointPilihanGanda::where("detail_kategori_kuisioner_id", $data["id"])->get();
                                    @endphp
                                    <div class="form-group mt-1 mb-2">
                                        <label class="form-label">
                                            {{ $data["nama_soal"] }}
                                        </label>
                                        <div class="form-check mb-3">
                                            @foreach ($data_point as $point_ganda)
                                            <input type="checkbox" class="form-check-input" name="pilihan-{{ $point_ganda["detail_kategori_kuisioner"]["slug"] }}[]" value="{{ $point_ganda["nama_point"] }}">
                                            <label for="" class="form-check-label">
                                                {{ $point_ganda["nama_point"] }}
                                            </label>
                                            <br>
                                            @endforeach
                                        </div>
                                    </div>
                                    @elseif($data["tipe_soal"] == 3)
                                    @php
                                    $data_point = PointPilihanTunggal::where("detail_kategori_kuisioner_id", $data["id"])->get();
                                    @endphp
                                    <div class="form-group mt-1 mb-2">
                                        <label for="form-label"> {{ $data["nama_soal"] }} </label>
                                        
                                        @if ($data_point->where("is_child", 1)->count() > 0)
                                        @foreach ($data_point as $item)
                                        @if ($item["is_child"] == 1)
                                        <div style="margin-bottom: 10px;">
                                            <strong style="text-transform: uppercase"> 
                                                {{ $item["nama_point"] }}
                                            </strong>
                                            <br>
                                            <input type="radio" required name="{{ $data["slug"] }}_{{ $loop->iteration }}" value="1"> Sangat Besar &nbsp;
                                            <input type="radio" required name="{{ $data["slug"] }}_{{ $loop->iteration }}" value="2"> Besar || &nbsp;
                                            <input type="radio" required name="{{ $data["slug"] }}_{{ $loop->iteration }}" value="3"> Cukup Besar || &nbsp;
                                            <input type="radio" required name="{{ $data["slug"] }}_{{ $loop->iteration }}" value="4"> Kurang || &nbsp;
                                            <input type="radio" required name="{{ $data["slug"] }}_{{ $loop->iteration }}" value="5"> Tidak Sama Sekali
                                        </div>
                                        @endif
                                        @endforeach    
                                        @else
                                        <select name={{ $data["slug"] }} class="form-control @error($data["slug"]) {{ 'is-invalid' }} @enderror" id={{ $data["slug"] }}>
                                            <option value="">- Pilih -</option>
                                            @foreach ($data_point as $point)
                                            <option value="{{ $point["nama_point"] }}" {{ old($data["slug"]) == $point["id"] ? 'selected' : '' }} >
                                                {{ $point["nama_point"] }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error($data["slug"])
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                        @endif
                                    </div>
                                    @endif
                                    @endforeach
                                    @endforeach
                                </div>
                                <div class="card-footer">
                                    <button type="button" data-bs-dismiss="modal" class="btn btn-danger btn-sm waves-effect waves-light">
                                        <i class="fa fa-times"></i> Batal
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">
                                        <i class="fa fa-save"></i> Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Tambah Data -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">
                    <i class="fa fa-plus"></i> Tambah Data
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <form action="{{ url('/alumni/riwayat_pekerjaan') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <h3 class="card-title">
                        Data Instansi
                    </h3>
                    <hr>
                    
                    {{-- <div class="row">
                        <label class="control-label" class="col-md-3"> Cari Instansi </label>
                        <div class="col-md-7">
                            <input type="hidden" value="0" id="type-instansi" name="cari_instansi">

                            <input class="form-control" id="instansi-search" type="text" autocomplete="off">
                        </div>
                    </div>
                    
                    <hr> --}}
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group d-none">
                                <label for="nama_instansi"> Instansi </label>
                                <input type="text" class="form-control @error("nama_instansi") {{ 'is-invalid' }} @enderror" name="nama_instansi" id="nama_instansi" placeholder="Masukkan Nama Instansi" value="{{ old('nama_instansi') }}">
                                <select name="database_instansi" class="form-control" id="database_instansi" style="display: none;">
                                    <option value="">- Pilih -</option>
                                    @foreach ($instansi as $item)
                                    <option value="{{ $item["id"] }}">
                                        {{ $item["nama_instansi"] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @error("nama_instansi")
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror

                            <div class="form-group">
                                <label class="control-label" class="col-md-3"> Nama Instansi </label>
                                <input type="hidden" value="0" id="type-instansi" name="cari_instansi">

                                <input class="form-control" id="instansi-search" type="text" autocomplete="off" name="nama_instansi">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="skala"> Skala </label>
                                <select name="skala" class="form-control @error("skala") {{ 'is-invalid' }} @enderror " id="skala">
                                    <option value="">- Pilih -</option>
                                    <option value="Lokal">Lokal</option>
                                    <option value="Nasional">Nasional</option>
                                    <option value="Internasional">Internasional</option>
                                </select>
                            </div>
                            @error("skala")
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
                                <label for="profesi"> Profesi </label>
                                <input type="text" class="form-control @error("profesi") {{ 'is-invalid' }}  @enderror" name="profesi" id="profesi" placeholder="Masukkan Profesi" value="{{ old('profesi') }}">
                            </div>
                            @error("profesi")
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="penghasilan_tiap_bulan"> Penghasilan Tiap Bulan </label>
                                <input type="number" class="form-control @error("penghasilan_tiap_bulan") {{ 'is-invalid' }} @enderror" name="penghasilan_tiap_bulan" id="penghasilan_tiap_bulan" placeholder="Rp. 1.000.000" value="{{ old('penghasilan_tiap_bulan') }}">
                            </div>
                            @error("penghasilan_tiap_bulan")
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
                                <label for="periode_kerja_mulai"> Periode Mulai </label>
                                <div class="row">
                                    <div class="col-md-5">
                                        <select name="periode_bulan_mulai" class="form-control" id="periode_bulan_mulai">
                                            <option value="">- Pilih -</option>
                                            @foreach ($bulan as $index => $value)
                                            <option value="{{ $index }}">
                                                {{ $value }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="year" class="form-control @error("periode_kerja_mulai") {{ 'is-invalid' }} @enderror" name="periode_kerja_mulai" id="periode_kerja_mulai" placeholder="0" value="{{ old('periode_kerja_mulai') }}">
                                    </div>
                                    @error("periode_kerja_mulai")
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="periode_kerja_akhir"> Periode Akhir </label>
                                <div class="row">
                                    <div class="col-md-5">
                                        <select name="periode_bulan_akhir" class="form-control" id="periode_bulan_akhir">
                                            <option value="">- Pilih -</option>
                                            @foreach ($bulan as $index => $value)
                                            <option value="{{ $index }}">
                                                {{ $value }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="year" class="form-control @error("periode_kerja_akhir") {{ 'is-invalid' }} @enderror" name="periode_kerja_akhir" id="periode_kerja_akhir" placeholder="0" value="{{ old('periode_kerja_akhir') }}">
                                        @error("periode_kerja_akhir")
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
                    <div class="row" id="wilayah">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="provinsi"> Provinsi </label>
                                <select name="provinsi" class="form-control" id="provinsi_pekerjaan">
                                    <option value="">- Pilih -</option>
                                    @foreach ($provinsi as $item)
                                        <option value="{{ $item['id'] }}">
                                            {{ $item["name"] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="kota_kab"> Kota Kabupaten </label>
                                <select name="kota_kab" class="form-control" id="kota_kab_pekerjaan">
                                    <option value="">- Pilih Kota Kabupaten -</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="kecamatan"> Kecamatan </label>
                                <select name="kecamatan" class="form-control" id="kecamatan_pekerjaan">
                                    <option value="">- Pilih Kecamatan -</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="kelurahan"> Kelurahan </label>
                                <select name="kelurahan" class="form-control" id="kelurahan_pekerjaan">
                                    <option value="">- Pilih Kecamatan -</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group" id="instansi_alamat">
                        <label for="alamat_instansi"> Alamat </label>
                        <textarea name="alamat_instansi" class="form-control @error("alamat_instansi") {{ 'is-invalid' }} @enderror " id="alamat_instansi" cols="30" rows="5" placeholder="Masukkan Alamat">{{ old('alamat_instansi') }}</textarea>
                    </div>
                    @error("alamat_instansi")
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                    @enderror
                    <hr>
                    <h3 class="card-title">
                        Data Atasan Alumni
                    </h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pengguna_alumni">Nama</label>
                                <input type="text" class="form-control @error("pengguna_alumni") {{ 'is-invalid' }} @enderror" name="pengguna_alumni" id="pengguna_alumni" placeholder="Masukkan Nama Atasan" value="{{ old('pengguna_alumni') }}">
                            </div>
                            @error("pengguna_alumni")
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control @error("email") {{ 'is-invalid' }} @enderror " name="email" id="email" placeholder="Masukkan Email" value="{{ old('email') }}">
                            </div>
                            @error("email")
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
                                <label for="divisi">Divisi</label>
                                <input type="text" class="form-control @error("divisi") {{ 'is-invalid' }} @enderror " name="divisi" id="divisi" placeholder="Masukkan Divisi" value="{{ old('divisi') }}">
                            </div>
                            @error("divisi")
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nomor_hp">Nomor HP</label>
                                <input type="text" class="form-control @error("nomor_hp") {{ 'is-invalid' }} @enderror " name="nomor_hp" id="nomor_hp" placeholder="+62" value="{{ old('nomor_hp') }}">
                            </div>
                            @error("nomor_hp")
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
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
@foreach ($riwayat as $item)
<div class="modal fade bs-example-modal-lg-edit-{{ $item["id"] }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">
                    <i class="fa fa-edit"></i> Edit Data
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <form action="{{ url('/alumni/riwayat_pekerjaan/'.$item["id"]) }}" method="POST">
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <h3 class="card-title">
                        Data Instansi
                    </h3>
                    <hr>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_instansi"> Instansi </label>
                                <input type="text" class="form-control @error("nama_instansi") {{ 'is-invalid' }}  @enderror" name="nama_instansi" id="nama_instansi" placeholder="Masukkan Nama Instansi" value="{{ old('nama_instansi') ?? $item["nama_instansi"] ?? '' }}" readonly>
                            </div>
                            @error("nama_instansi")
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="skala"> Skala </label>
                                <select name="skala" class="form-control" id="skala">
                                    <option value="">- Pilih -</option>
                                    @if ($item["skala"] == "Lokal")
                                    <option value="Lokal" selected>Lokal</option>
                                    <option value="Nasional">Nasional</option>
                                    <option value="Internasional">Internasional</option>
                                    @elseif($item["skala"] == "Nasional")
                                    <option value="Lokal">Lokal</option>
                                    <option value="Nasional" selected>Nasional</option>
                                    <option value="Internasional">Internasional</option>
                                    @elseif($item["skala"] == "Internasional")
                                    <option value="Lokal">Lokal</option>
                                    <option value="Nasional">Nasional</option>
                                    <option value="Internasional" selected>Internasional</option>
                                    @else
                                    <option value="Lokal">Lokal</option>
                                    <option value="Nasional">Nasional</option>
                                    <option value="Internasional">Internasional</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="profesi"> Profesi </label>
                                <input type="text" class="form-control @error("profesi") {{ 'is-invalid' }} @enderror " name="profesi" id="profesi" placeholder="Masukkan Profesi" value="{{ old('profesi') ?? $item["profesi"] ?? '' }}">
                            </div>
                            @error("profesi")
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="penghasilan_tiap_bulan"> Penghasilan Tiap Bulan </label>
                                <input type="number" class="form-control @error("penghasilan_tiap_bulan") {{ 'is-invalid' }} @enderror" name="penghasilan_tiap_bulan" id="penghasilan_tiap_bulan" placeholder="Rp. 1.000.000" value="{{ old('penghasilan_tiap_bulan') ?? $item["penghasilan_tiap_bulan"] ?? '' }}">
                            </div>
                            @error("penghasilan_tiap_bulan")
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
                                <label for="periode_kerja_mulai"> Periode Mulai </label>
                                <div class="row">
                                    <div class="col-md-5">
                                        <select name="periode_bulan_mulai" class="form-control" id="periode_bulan_mulai">
                                            <option value="">- Pilih -</option>
                                            @foreach ($bulan as $index => $value)
                                            <option value="{{ $index }}" {{ $index == $item["periode_bulan_mulai"] ? 'selected' : '' }} >
                                                {{ $value }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="year" class="form-control @error("periode_kerja_mulai") {{ 'is-invalid' }} @enderror" name="periode_kerja_mulai" id="periode_kerja_mulai" placeholder="0" value="{{ old('periode_kerja_mulai') ?? $item["periode_kerja_mulai"] ?? '' }}">
                                    </div>
                                    @error("periode_kerja_mulai")
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="periode_kerja_akhir"> Periode Akhir </label>
                                <div class="row">
                                    <div class="col-md-5">
                                        <select name="periode_bulan_akhir" class="form-control" id="periode_bulan_akhir">
                                            <option value="">- Pilih -</option>
                                            @foreach ($bulan as $index => $value)
                                            <option value="{{ $index }}" {{ $index == $item["periode_bulan_akhir"] ? 'selected' : '' }} >
                                                {{ $value }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="year" class="form-control @error("periode_kerja_akhir") {{ 'is-invalid' }} @enderror" name="periode_kerja_akhir" id="periode_kerja_akhir" placeholder="0" value="{{ old('periode_kerja_akhir') ?? $item['periode_kerja_akhir'] ?? '' }}">
                                        @error("periode_kerja_akhir")
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
                    <div class="row" id="wilayah">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="provinsi"> Provinsi </label>
                                <select name="provinsi" class="form-control" id="provinsi_pekerjaan_{{$item['id']}}">
                                    <option value="">- Pilih -</option>
                                    @foreach ($provinsi as $edit)
                                        <option value="{{ $edit['id'] }}" {{ $edit["name"] == $item["provinsi"] ? 'selected' : '' }} >
                                            {{ $edit["name"] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="kota_kab"> Kota Kabupaten </label>
                                <select name="kota_kab" class="form-control" id="kota_kab_pekerjaan_{{$item['id']}}">
                                    @if (!empty($item["kota_kab"]))
                                        <option value="" disabled selected>
                                            {{ $item["kota_kab"] }}
                                        </option>
                                    @else
                                    <option value="">- Pilih Kota Kabupaten -</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="kecamatan"> Kecamatan </label>
                                <select name="kecamatan" class="form-control" id="kecamatan_pekerjaan_{{$item['id']}}">
                                    @if (!empty($item["kecamatan"]))
                                    <option value="" disabled selected>
                                        {{ $item["kecamatan"] }}
                                    </option>
                                    @else
                                    <option value="">- Pilih Kecamatan -</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="kelurahan"> Kelurahan </label>
                                <select name="kelurahan" class="form-control" id="kelurahan_pekerjaan_{{$item['id']}}">
                                    @if (!empty($item["kelurahan"]))
                                        <option value="" disabled selected>
                                            {{ $item["kelurahan"] }}
                                        </option>
                                    @else
                                    <option value="">- Pilih Kecamatan -</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="alamat_instansi"> Alamat </label>
                        <textarea name="alamat_instansi" class="form-control @error("alamat") {{ 'is-invalid' }} @enderror " id="alamat_instansi" cols="30" rows="5" placeholder="Masukkan Alamat">{{ old('alamat') ?? $item["alamat_instansi"] ?? '' }}</textarea>
                    </div>
                    @error("alamat")
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                    @enderror
                    <hr>
                    <h3 class="card-title">
                        Data Atasan Alumni
                    </h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pengguna_alumni">Nama</label>
                                <input type="text" class="form-control @error("pengguna_alumni") {{ 'is-invalid' }} @enderror" name="pengguna_alumni" id="pengguna_alumni" placeholder="Masukkan Nama Atasan" value="{{ old('pengguna_alumni') ?? $item["pengguna_alumni"] ?? '' }}">
                            </div>
                            @error("pengguna_alumni")
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control @error("email") {{ 'is-invalid' }} @enderror " name="email" id="email" placeholder="Masukkan Email" value="{{ old('email') ?? $item["email"] ?? '' }}">
                            </div>
                            @error("email")
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
                                <label for="divisi">Divisi</label>
                                <input type="text" class="form-control @error("divisi") {{ 'is-invalid' }} @enderror" name="divisi" id="divisi" placeholder="Masukkan Divisi" value="{{ old('divisi') ?? $item["divisi"] ?? '' }}">
                            </div>
                            @error("divisi")
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nomor_hp">Nomor HP</label>
                                <input type="number" class="form-control @error("nomor_hp") {{ 'is-invalid' }} @enderror " name="nomor_hp" id="nomor_hp" placeholder="0" value="{{ old('nomor_hp') ?? $item["nomor_hp"] ?? '' }}">
                            </div>
                            @error("nomor_hp")
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
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

<!-- Detail Data -->
@foreach ($riwayat as $item)
<div class="modal fade bs-example-modal-lg-detail-{{ $item["id"] }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">
                    <i class="fa fa-search"></i> Detail Data
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h3 class="card-title">
                    Data Instansi
                </h3>
                <hr>
                <table style="width: 100%;" class="table table-bordered">
                    <tr>
                        <td style="width: 200px">Instansi</td>
                        <td style="width: 50px" class="text-center">:</td>
                        <td>
                            {{ $item["nama_instansi"] }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 200px">Skala</td>
                        <td style="width: 50px" class="text-center">:</td>
                        <td>
                            {{ $item["skala"] }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 200px">Profesi</td>
                        <td style="width: 50px" class="text-center">:</td>
                        <td>
                            {{ $item["profesi"] }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 200px">Penghasilan Tiap Bulan</td>
                        <td style="width: 50px" class="text-center">:</td>
                        <td>
                            Rp. {{ number_format($item["penghasilan_tiap_bulan"]) }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 200px">Periode Mulai</td>
                        <td style="width: 50px" class="text-center">:</td>
                        <td>
                            @if ($item["periode_bulan_mulai"] == 1)
                            Januari
                            @elseif($item["periode_bulan_mulai"] == 2)
                            Februari
                            @elseif($item["periode_bulan_mulai"] == 3)
                            Maret
                            @elseif($item["periode_bulan_mulai"] == 4)
                            April
                            @elseif($item["periode_bulan_mulai"] == 5)
                            Mei
                            @elseif($item["periode_bulan_mulai"] == 6)
                            Juni
                            @elseif($item["periode_bulan_mulai"] == 7)
                            Juli
                            @elseif($item["periode_bulan_mulai"] == 8)
                            Agustus
                            @elseif($item["periode_bulan_mulai"] == 9)
                            September
                            @elseif($item["periode_bulan_mulai"] == 10)
                            Oktober
                            @elseif($item["periode_bulan_mulai"] == 11)
                            November
                            @elseif($item["periode_bulan_mulai"] == 12)
                            Desember
                            @endif
                            {{ $item["periode_kerja_mulai"] }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 200px">Periode Akhir</td>
                        <td style="width: 50px" class="text-center">:</td>
                        <td>
                            @if ($item["periode_bulan_akhir"] == 1)
                            Januari
                            @elseif($item["periode_bulan_akhir"] == 2)
                            Februari
                            @elseif($item["periode_bulan_akhir"] == 3)
                            Maret
                            @elseif($item["periode_bulan_akhir"] == 4)
                            April
                            @elseif($item["periode_bulan_akhir"] == 5)
                            Mei
                            @elseif($item["periode_bulan_akhir"] == 6)
                            Juni
                            @elseif($item["periode_bulan_akhir"] == 7)
                            Juli
                            @elseif($item["periode_bulan_akhir"] == 8)
                            Agustus
                            @elseif($item["periode_bulan_akhir"] == 9)
                            September
                            @elseif($item["periode_bulan_akhir"] == 10)
                            Oktober
                            @elseif($item["periode_bulan_akhir"] == 11)
                            November
                            @elseif($item["periode_bulan_akhir"] == 12)
                            Desember
                            @endif
                            {{ $item['periode_kerja_akhir'] }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 200px">Alamat</td>
                        <td style="width: 50px" class="text-center">:</td>
                        <td>
                            {{ $item["alamat_instansi"] }}
                        </td>
                    </tr>
                </table>
                <hr>
                <h3 class="card-title">
                    Data Atasan Alumni
                </h3>
                <hr>
                <table style="width: 100%;" class="table table-responsive">
                    <tr>
                        <td style="width: 200px">Nama</td>
                        <td style="width: 50px" class="text-center">:</td>
                        <td>
                            {{ $item["pengguna_alumni"] }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 200px">Email</td>
                        <td style="width: 50px" class="text-center">:</td>
                        <td>
                            {{ $item["email"] }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 200px">Divisi</td>
                        <td style="width: 50px" class="text-center">:</td>
                        <td>
                            {{ $item["divisi"] }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 200px">Nomor HP</td>
                        <td style="width: 50px" class="text-center">:</td>
                        <td>
                            {{ $item["nomor_hp"] }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- END -->

@endsection

@section('javascript')

<script src="{{ url('') }}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ url('') }}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ url('') }}/assets/js/pages/datatables.init.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ asset('assets/typeahead/typeahead.bundle.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

        $('.tt-dataset-instansi').on('click', '.tt-suggestion.tt-selectable', function() {
            let data = {
                nama_instansi : $(this).text(),
            }
            $.ajax({
                type: 'GET',
                data : data,
                url: "<?php echo url('detail_instansi'); ?>",
                beforeSend: function() {

                },
                success: function(response) {
                    if(response){
                        $("#type-instansi").val(1);
                        inputInstansi();
                        $("#database_instansi").val(response.id);
                    }
                }
            });
        });
    });

    var instansi = <?=$instansiAutoComplete;?>;
    var substringMatcher = function(strs) {
        return function findMatches(q, cb) {
          var matches, substringRegex;
          // an array that will be populated with substring matches
          matches = [];
          // regex used to determine if a string contains the substring `q`
          substrRegex = new RegExp(q, 'i');
          // iterate through the pool of strings and for any string that
          // contains the substring `q`, add it to the `matches` array
          $.each(strs, function(i, str) {
            if (substrRegex.test(str)) {
              matches.push(str);
            }
          });
          cb(matches);
        };
    };

    function inputInstansi(){
        let cari = $("#type-instansi").val();

        if (cari == 1) {
            $("#database_instansi").show();
            $("#nama_instansi").hide();
            $("#instansi_alamat").hide();
            $("#wilayah").hide();
            $("#nama_instansi").val('');
            $("#instansi_alamat").val('');
            $("#provinsi_pekerjaan").val('');
            $("#kota_kab_pekerjaan").val('');
            $("#kecamatan_pekerjaan").val('');
            $("#kelurahan_pekerjaan").val('');
        } else {
            $("#nama_instansi").show();
            $("#instansi_alamat").show();
            $("#wilayah").show();
            $("#database_instansi").hide();
            $("#database_instansi").val('');
        }
    };

    $('#instansi-search').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'instansi',
            source: substringMatcher(instansi),
            templates: {
                empty: function(){
                    $("#type-instansi").val(0);
                    inputInstansi();
                }
            }
        }
    );
</script>
<script type="text/javascript">

    $(document).ready(function() {

        $("#provinsi").change(function() {
            let provinsi = $("#provinsi").val();
            console.log(provinsi);
            $.ajax({
                url: "{{ url('/alumni/wilayah/ambil_kota_kab') }}",
                type: "GET",
                data: { provinsi: provinsi },
                success: function(res) {
                    console.log(res);
                    $("#kota_kab").html(res);
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });

        $("#kota_kab").change(function() {
            let kota_kab = $("#kota_kab").val();

            $.ajax({
                url: "{{ url('/alumni/wilayah/ambil_kecamatan') }}",
                type: "GET",
                data: { kota_kab: kota_kab },
                success: function(res) {
                    $("#kecamatan").html(res);
                }
            });
        });

        $("#kecamatan").change(function() {
            let kecamatan = $("#kecamatan").val();

            $.ajax({
                url: "{{ url('/alumni/wilayah/ambil_kelurahan') }}",
                type: "GET",
                data: { kecamatan: kecamatan },
                success: function(res) {
                    $("#kelurahan").html(res);
                }
            });
        });

        $("#provinsi_pekerjaan").change(function() {
            let provinsi = $("#provinsi_pekerjaan").val();
            $.ajax({
                url: "{{ url('/alumni/wilayah/ambil_kota_kab') }}",
                type: "GET",
                data: { provinsi: provinsi },
                success: function(res) {
                    console.log(res);
                    $("#kota_kab_pekerjaan").html(res);
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });

        $("#kota_kab_pekerjaan").change(function() {
            let kota_kab = $("#kota_kab_pekerjaan").val();

            $.ajax({
                url: "{{ url('/alumni/wilayah/ambil_kecamatan') }}",
                type: "GET",
                data: { kota_kab: kota_kab },
                success: function(res) {
                    $("#kecamatan_pekerjaan").html(res);
                }
            });
        });

        $("#kecamatan_pekerjaan").change(function() {
            let kecamatan = $("#kecamatan_pekerjaan").val();

            $.ajax({
                url: "{{ url('/alumni/wilayah/ambil_kelurahan') }}",
                type: "GET",
                data: { kecamatan: kecamatan },
                success: function(res) {
                    $("#kelurahan_pekerjaan").html(res);
                }
            });
        });
    });


    
</script>

@endsection
