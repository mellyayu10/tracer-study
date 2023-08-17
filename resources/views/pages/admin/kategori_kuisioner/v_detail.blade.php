@php
    use App\Models\SettingKategoriKuisioner;
@endphp

@extends("pages.layouts.main")

@section("title", "Data Kategori Kuisioner")

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
                        <li class="breadcrumb-item">
                            <a href="{{ url('/admin/kategori_kuisioner') }}">
                                Kategori Kuisioner
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Detail Kategori Kuisioner
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
    
    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center-setting">
        <i class="fa fa-plus"></i> Setting Kategori Kuisioner
    </button>
    
    <br><br>

    @forelse ($setting as $set)
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    @if ($set["setting"] == 1)
                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center">
                        <i class="fa fa-plus"></i> Tambah Data
                    </button>
                    @elseif($set["setting"] == 2)
                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-pilihan-ganda">
                        <i class="fa fa-plus"></i> Tambah Data
                    </button>
                    @elseif($set["setting"] == 3)
                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-pilihan-tunggal">
                        <i class="fa fa-plus"></i> Tambah Data
                    </button>
                    @endif

                    <span class="text-primary" style="float: right;">
                        @if ($set["setting"] == 1)
                            Isian    
                        @elseif($set["setting"] == 2)
                            Pilihan Ganda
                        @elseif($set["setting"] == 3)
                            Pilihan Tunggal
                        @endif
                    </span>
                    <br><br>
                    <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th>Pertanyaan Soal</th>
                                <th class="text-center">Kuisioner Bercabang</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($set["setting"] == 1)
                            @forelse ($kategori_isian as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}.</td>
                                <td>{{ $item["nama_soal"] }}</td>
                                <td class="text-center">
                                    @if ($item["is_kuisioner"] == "1")
                                        <button class="btn btn-success btn-sm">
                                            <i class="fa fa-check"></i> Ya
                                        </button>
                                    @elseif($item["is_kuisioner"] == "0")
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fa fa-times"></i> Tidak
                                        </button>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-warning btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center-edit-{{ $item["id"] }}">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                    <form action="{{ url('/admin/kategori_kuisioner/'.$item->id.'/isian/') }}" method="POST" style="display: inline">
                                        @csrf
                                        @method("DELETE")
                                        <button onclick="return confirm('Yakin ? Apakah Anda Ingin Menghapus Data Ini ?')" type="submit" class="btn btn-danger btn-sm waves-effect waves-light">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">
                                    <strong>
                                        Data Belum Ada
                                    </strong>
                                </td>
                            </tr>
                            @endforelse
                            @elseif ($set["setting"] == 2)
                            @forelse ($pilihan_ganda as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}.</td>
                                <td>{{ $item["nama_soal"] }}</td>
                                <td class="text-center">
                                    @if ($item["is_kuisioner"] == "1")
                                        <button class="btn btn-success btn-sm">
                                            <i class="fa fa-check"></i> Ya
                                        </button>
                                    @elseif($item["is_kuisioner"] == "0")
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fa fa-times"></i> Tidak
                                        </button>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ url('/admin/kategori_kuisioner/'.$detail["id"].'/pilihan_ganda/'.$item["id"] . '/detail') }}" class="btn btn-primary btn-sm waves-effect waves-light">
                                        <i class="fa fa-plus"></i> Tambah Point
                                    </a>
                                    <button type="button" class="btn btn-warning btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center-pilihan-ganda-edit-{{ $item["id"] }}">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                    <form action="{{ url('/admin/kategori_kuisioner/'.$item->id.'/pilihan_ganda') }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button onclick="return confirm('Yakin ? Apakah Anda Ingin Menghapus Data Ini ?')" type="submit" class="btn btn-danger btn-sm waves-effect waves-light">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">
                                    <strong>
                                        Data Belum Ada
                                    </strong>
                                </td>
                            </tr>
                            @endforelse
                            @elseif ($set["setting"] == 3)
                            @forelse ($pilihan_tunggal as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}.</td>
                                <td>{{ $item["nama_soal"] }}</td>
                                <td class="text-center">
                                    @if ($item["is_kuisioner"] == "1")
                                        <button class="btn btn-success btn-sm">
                                            <i class="fa fa-check"></i> Ya
                                        </button>
                                    @elseif($item["is_kuisioner"] == "0")
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fa fa-times"></i> Tidak
                                        </button>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ url('/admin/kategori_kuisioner/'.$detail['id'] . '/pilihan_tunggal/' . $item["id"] . '/detail') }}" class="btn btn-success btn-sm waves-effect waves-light">
                                        <i class="fa fa-plus"></i> Tambah Data
                                    </a>
                                    <button type="button" class="btn btn-warning btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center-pilihan-tunggal-edit-{{ $item["id"] }}">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                    <form action="{{ url('/admin/kategori_kuisioner/'.$item->id.'/pilihan_tunggal') }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method("DELETE")
                                        <button onclick="return confirm('Yakin ? Apakah Anda Ingin Menghapus Data Ini ?')" type="submit" class="btn btn-danger btn-sm waves-effect waves-light">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">
                                    <strong>
                                        Data Belum Ada
                                    </strong>
                                </td>
                            </tr>
                            @endforelse
                            @endif
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger">
                <strong>
                    <i>
                        Silahkan Setting Terlebih Dahulu
                    </i>
                </strong>
            </div>
        </div>
    </div>
    @endforelse
</div>

<!-- Tambah Data Setting -->
<div class="modal fade bs-example-modal-center-setting" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    <i class="fa fa-plus"></i> Tambah Data
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Kategori</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $item)
                            @php
                                $cek = SettingKategoriKuisioner::where("kategori_kuisioner_id", $detail["id"])->first();
                            @endphp
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}.</td>
                                <td>{{ $item["nama_kategori"] }}</td>
                                <td class="text-center">
                                    @if (empty($cek))
                                    <form action="{{ url('/admin/setting_kategori_kuisioner/aktifkan') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="kategori_kuisioner_id" value="{{ $detail["id"] }}">
                                        <input type="hidden" name="setting" value="{{ $item["id"] }}">
                                        <button class="btn btn-success btn-sm">
                                            <i class="fa fa-thumbs-up"></i> Aktifkan
                                        </button>
                                    </form>
                                    @else
                                        @php
                                            $cek_setting = SettingKategoriKuisioner::where("kategori_kuisioner_id", $detail["id"])->where("setting", $item["id"])->first();
                                        @endphp

                                        @if (empty($cek_setting))
                                        <form action="{{ url('/admin/setting_kategori_kuisioner/aktifkan') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="kategori_kuisioner_id" value="{{ $detail["id"] }}">
                                            <input type="hidden" name="setting" value="{{ $item["id"] }}">
                                            <button class="btn btn-success btn-sm">
                                                <i class="fa fa-thumbs-up"></i> Aktifkan
                                            </button>
                                        </form>
                                        @else
                                        <form action="{{ url('/admin/setting_kategori_kuisioner/non_aktifkan') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $cek_setting["id"] }}">
                                            <input type="hidden" name="kategori_kuisioner_id" value="{{ $detail["id"] }}">
                                            <input type="hidden" name="setting" value="{{ $item["id"] }}">
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fa fa-times"></i> Non-Aktifkan
                                            </button>
                                        </form>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- END -->

<!-- Tambah Data Isian -->
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    <i class="fa fa-plus"></i> Tambah Data | 
                    <span class="text-primary">
                        Isian
                    </span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <form action="{{ url('/admin/kategori_kuisioner/' . $detail["id"] . '/isian') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_soal"> Pertanyaan Soal </label>
                        <input type="text" class="form-control @error("nama_soal") {{ 'is-invalid' }} @enderror " name="nama_soal" id="nama_soal" placeholder="Masukkan Pertanyaan Soal" value="{{ old("nama_soal") }}">
                    </div>
                    @error("nama_soal")
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                    @enderror
                    <br>
                    <div class="form-group">
                        <label for="is_kuisioner"> Kuisioner Bercabang ? </label>
                        <select name="is_kuisioner" class="form-control @error("is_kuisioner") {{ 'is-invalid' }} @enderror" id="is_kuisioner">
                            <option value="">- Pilih -</option>
                            <option value="1" {{ old('is_kuisioner') == "1" ? 'selected' : '' }} >Ya</option>
                            <option value="0" {{ old('is_kuisioner') == "0" ? 'selected' : '' }} >Tidak</option>
                        </select>
                    </div>
                    @error("is_kuisioner")
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

<!-- Detail Data Kategori Isian -->
@foreach ($kategori_isian as $item)
<div class="modal fade bs-example-modal-center-edit-{{ $item["id"] }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    <i class="fa fa-edit"></i> Edit Data
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <form action="{{ url('/admin/kategori_kuisioner/' . $detail["id"] . '/isian' . '/' . $item['id']) }}" method="POST">
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_soal"> Pertanyaan Soal </label>
                        <input type="text" class="form-control @error("nama_soal") {{ 'is-invalid' }} @enderror " name="nama_soal" id="nama_soal" placeholder="Masukkan Pertanyaan Soal" value="{{ old("nama_soal") ?? $item["nama_soal"] ?? '' }}">
                    </div>
                    @error("nama_soal")
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                    @enderror
                    <br>
                    <div class="form-group">
                        <label for="is_kuisioner"> Kuisioner Bercabang ? </label>
                        <select name="is_kuisioner" class="form-control @error("is_kuisioner") {{ 'is-invalid' }} @enderror" id="is_kuisioner">
                            <option value="">- Pilih -</option>
                            <option value="1" {{ old('is_kuisioner') || $item["is_kuisioner"] == "1" ? 'selected' : '' }} >Ya</option>
                            <option value="0" {{ old('is_kuisioner') || $item["is_kuisioner"]  == "0" ? 'selected' : '' }} >Tidak</option>
                        </select>
                    </div>
                    @error("is_kuisioner")
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

<!-- Tambah Data Pilihan Ganda -->
<div class="modal fade bs-example-modal-pilihan-ganda" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    <i class="fa fa-plus"></i> Tambah Data | 
                    <span class="text-primary">
                        Pilihan Ganda
                    </span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <form action="{{ url('/admin/kategori_kuisioner/' . $detail["id"] . '/pilihan_ganda') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_soal"> Pertanyaan Soal </label>
                        <input type="text" class="form-control @error("nama_soal") {{ 'is-invalid' }} @enderror " name="nama_soal" id="nama_soal" placeholder="Masukkan Pertanyaan Soal" value="{{ old("nama_soal") }}">
                    </div>
                    @error("nama_soal")
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                    @enderror
                    <br>
                    <div class="form-group">
                        <label for="is_kuisioner"> Kuisioner Bercabang ? </label>
                        <select name="is_kuisioner" class="form-control @error("is_kuisioner") {{ 'is-invalid' }} @enderror" id="is_kuisioner">
                            <option value="">- Pilih -</option>
                            <option value="1" {{ old('is_kuisioner') == "1" ? 'selected' : '' }} >Ya</option>
                            <option value="0" {{ old('is_kuisioner') == "0" ? 'selected' : '' }} >Tidak</option>
                        </select>
                    </div>
                    @error("is_kuisioner")
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

<!-- Detail Data Pilihan Ganda -->
@foreach ($pilihan_ganda as $item)
<div class="modal fade bs-example-modal-center-pilihan-ganda-edit-{{ $item["id"] }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    <i class="fa fa-edit"></i> Edit Data
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <form action="{{ url('/admin/kategori_kuisioner/' . $detail["id"] . '/pilihan_ganda' . '/' . $item['id']) }}" method="POST">
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_soal"> Pertanyaan Soal </label>
                        <input type="text" class="form-control @error("nama_soal") {{ 'is-invalid' }} @enderror " name="nama_soal" id="nama_soal" placeholder="Masukkan Pertanyaan Soal" value="{{ old("nama_soal") ?? $item["nama_soal"] ?? '' }}">
                    </div>
                    @error("nama_soal")
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                    @enderror
                    <br>
                    <div class="form-group">
                        <label for="is_kuisioner"> Kuisioner Bercabang ? </label>
                        <select name="is_kuisioner" class="form-control @error("is_kuisioner") {{ 'is-invalid' }} @enderror" id="is_kuisioner">
                            <option value="">- Pilih -</option>
                            <option value="1" {{ old('is_kuisioner') || $item["is_kuisioner"] == "1" ? 'selected' : '' }} >Ya</option>
                            <option value="0" {{ old('is_kuisioner') || $item["is_kuisioner"]  == "0" ? 'selected' : '' }} >Tidak</option>
                        </select>
                    </div>
                    @error("is_kuisioner")
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

<!-- Tambah Data Pilihan Tunggal -->
<div class="modal fade bs-example-modal-pilihan-tunggal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    <i class="fa fa-plus"></i> Tambah Data | 
                    <span class="text-primary">
                        Pilihan Tunggal
                    </span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <form action="{{ url('/admin/kategori_kuisioner/' . $detail["id"] . '/pilihan_tunggal') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_soal"> Pertanyaan Soal </label>
                        <input type="text" class="form-control @error("nama_soal") {{ 'is-invalid' }} @enderror " name="nama_soal" id="nama_soal" placeholder="Masukkan Pertanyaan Soal" value="{{ old("nama_soal") }}">
                    </div>
                    @error("nama_soal")
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                    @enderror
                    <br>
                    <div class="form-group">
                        <label for="is_kuisioner"> Kuisioner Bercabang ? </label>
                        <select name="is_kuisioner" class="form-control @error("is_kuisioner") {{ 'is-invalid' }} @enderror" id="is_kuisioner">
                            <option value="">- Pilih -</option>
                            <option value="1" {{ old('is_kuisioner') == "1" ? 'selected' : '' }} >Ya</option>
                            <option value="0" {{ old('is_kuisioner') == "0" ? 'selected' : '' }} >Tidak</option>
                        </select>
                    </div>
                    @error("is_kuisioner")
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

<!-- Detail Data Pilihan Tunggal -->
@foreach ($pilihan_tunggal as $item)
<div class="modal fade bs-example-modal-center-pilihan-tunggal-edit-{{ $item["id"] }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    <i class="fa fa-edit"></i> Edit Data
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <form action="{{ url('/admin/kategori_kuisioner/' . $detail["id"] . '/pilihan_tunggal' . '/' . $item['id']) }}" method="POST">
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_soal"> Pertanyaan Soal </label>
                        <input type="text" class="form-control @error("nama_soal") {{ 'is-invalid' }} @enderror " name="nama_soal" id="nama_soal" placeholder="Masukkan Pertanyaan Soal" value="{{ old("nama_soal") ?? $item["nama_soal"] ?? '' }}">
                    </div>
                    @error("nama_soal")
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                    @enderror
                    <br>
                    <div class="form-group">
                        <label for="is_kuisioner"> Kuisioner Bercabang ? </label>
                        <select name="is_kuisioner" class="form-control @error("is_kuisioner") {{ 'is-invalid' }} @enderror" id="is_kuisioner">
                            <option value="">- Pilih -</option>
                            <option value="1" {{ old('is_kuisioner') || $item["is_kuisioner"] == "1" ? 'selected' : '' }} >Ya</option>
                            <option value="0" {{ old('is_kuisioner') || $item["is_kuisioner"] == "0" ? 'selected' : '' }} >Tidak</option>
                        </select>
                    </div>
                    @error("is_kuisioner")
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
