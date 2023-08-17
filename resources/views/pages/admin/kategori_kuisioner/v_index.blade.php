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
                        <li class="breadcrumb-item active">
                            Kategori Kuisioner
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

    @if (session("message_error"))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="mdi mdi-check-all me-2"></i>
        {!! session("message_error") !!}
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
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th>Kategori Kuisioner</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Tipe Kuisioner</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori_kuisioner as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}.</td>
                                    <td>
                                        <a href="{{ url('/admin/kategori_kuisioner/'.$item["id"]) }}">
                                            {{ $item["nama_kategori_kuisioner"] }}
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        @if ($item["status"] == 1)
                                            <form action="{{ url('/admin/kategori_kuisioner/'.$item["id"] . '/non_aktifkan') }}" method="POST">
                                                @csrf
                                                @method("PUT")
                                                <button type="submit" class="btn btn-danger btn-sm waves-effect waves-light">
                                                    <i class="fa fa-times"></i> Non - Aktifkan    
                                                </button>    
                                            </form>    
                                        @elseif($item["status"] == 0)
                                            <form action="{{ url('/admin/kategori_kuisioner/'.$item["id"] . '/aktifkan') }}" method="POST">
                                                @csrf
                                                @method("PUT")
                                                <button type="submit" class="btn btn-success btn-sm waves-effect waves-light">
                                                    <i class="fa fa-thumbs-up"></i> Aktifkan
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($item["tipe_kuisioner"] == 1)
                                        <span class="text-success">
                                            <strong>
                                                Kuisioner Mahasiswa
                                            </strong>
                                        </span>
                                        @elseif($item["tipe_kuisioner"] == 2)
                                        <span class="text-primary">
                                            <strong>
                                                Kuisioner User Survey
                                            </strong>
                                        </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-warning btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center-edit-{{ $item["id"] }}">
                                            <i class="fa fa-edit"></i> Edit
                                        </button>
                                        <form action="{{ url('/admin/kategori_kuisioner/'.$item["id"]) }}" method="POST" style="display: inline">
                                            @csrf
                                            @method("DELETE")
                                            <button onclick="return confirm('Yakin ? Anda Ingin Menghapus Data Ini ?')" type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i> Hapus
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
            <form action="{{ url('/admin/kategori_kuisioner') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kategori_kuisioner"> Kategori Kuisioner </label>
                        <input type="text" class="form-control @error("nama_kategori_kuisioner") {{ 'is-invalid' }} @enderror " name="nama_kategori_kuisioner" id="nama_kategori_kuisioner" placeholder="Masukkan Kategori Kuisioner" value="{{ old("nama_kategori_kuisioner") }}">
                    </div>
                    @error("nama_kategori_kuisioner")
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror

                    <br>
                    
                    <div class="form-group">
                        <label for="tipe_kuisioner"> Tipe Kuisioner </label>
                        <select name="tipe_kuisioner" class="form-control @error("tipe_kuisioner") {{ 'is-invalid' }} @enderror " id="tipe_kuisioner">
                            <option value="">- Pilih -</option>
                            <option value="1" {{ old('tipe_kuisioner') == 1 ? 'selected' : '' }} >Kuisioner Mahasiswa</option>
                            <option value="2" {{ old('tipe_kuisioner') == 2 ? 'selected' : '' }} >Kuisioner User Survey</option>
                        </select>
                    </div>
                    @error("tipe_kuisioner")
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
@foreach ($kategori_kuisioner as $item)
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
            <form action="{{ url('/admin/kategori_kuisioner/'.$item["id"]) }}" method="POST">
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kategori_kuisioner"> Kategori Kuisioner </label>
                        <input type="text" class="form-control @error("nama_kategori_kuisioner") {{ 'is-invalid' }} @enderror " name="nama_kategori_kuisioner" id="nama_kategori_kuisioner" placeholder="Masukkan Kategori Kuisioner" value="{{ old('nama_kategori_kuisioner') ?? $item['nama_kategori_kuisioner'] ?? '' }}">
                    </div>
                    @error("nama_kategori_kuisioner")
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror

                    <br>

                    <div class="form-group">
                        <label for="tipe_kuisioner"> Tipe Kuisioner </label>
                        <select name="tipe_kuisioner" class="form-control @error("tipe_kuisioner") {{ 'is-invalid' }} @enderror " id="tipe_kuisioner">
                            <option value="">- Pilih -</option>
                            <option value="1" {{ $item["tipe_kuisioner"] == 1 ? 'selected' : '' }} >Kuisioner Mahasiswa</option>
                            <option value="2" {{ $item["tipe_kuisioner"] == 2 ? 'selected' : '' }} >Kuisioner User Survey</option>
                        </select>
                    </div>
                    @error("tipe_kuisioner")
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
