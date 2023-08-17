@extends("pages.layouts.main")

@section("title", "Data Administrator")

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
                            Administrator
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

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    {{-- <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center">
                        <i class="fa fa-plus"></i> Tambah Data
                    </button>
                    <br><br> --}}
                    <table id="datatable" class="table table-bordered dt-responsive nowrap table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $nomer = 0
                            @endphp
                            @foreach ($admin as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}.</td>
                                <td>{{ $item["nama"] }}</td>
                                <td>{{ $item["email"] }}</td>
                                <td class="text-center">
                                    @if ($item["id"] == Auth::user()->id)
                                    -
                                    @else
                                    <button type="button" class="btn btn-warning btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center-edit-{{ $item["id"] }}">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                    <form action="{{ url('/admin/data_administrator/'.$item['id']) }}" method="POST" style="display: inline">
                                        @csrf
                                        @method("DELETE")
                                        <button onclick="return confirm('Yakin ? Apakah Anda Ingin Menghapus Data Ini ?')" type="submit" class="btn btn-danger btn-sm waves-effect waves-light">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </form>
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
            <form action="{{ url('/admin/data_administrator') }}" method="POST">
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
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger btn-sm">
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
@foreach ($admin as $item)
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
            <form action="{{ url('/admin/data_administrator/'.$item["id"]) }}" method="POST">
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama"> Nama </label>
                        <input type="text" class="form-control @error("nama") {{ 'is-invalid' }} @enderror " name="nama" id="nama" placeholder="Masukkan Nama" value="{{ old('nama') ?? $item["nama"] ?? '' }}">
                    </div>
                    @error("nama")
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                    <br>
                    <div class="form-group">
                        <label for="email"> Email </label>
                        <input type="email" class="form-control @error("email") {{ 'is-invalid' }} @enderror " name="email" id="email" placeholder="Masukkan Email" value="{{ old('email') ?? $item["email"] ?? '' }}">
                    </div>
                    @error("email")
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                    <br>
                    <div class="form-group">
                        <label for="nomor_hp"> Nomor HP </label>
                        <input type="text" class="form-control @error("nomor_hp") {{ 'is-invalid' }} @enderror " name="nomor_hp" id="nomor_hp" placeholder="0" value="{{ old('nomor_hp') ?? $item['nomor_hp'] ?? '' }}">
                    </div>
                    @error('nomor_hp')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger btn-sm">
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
