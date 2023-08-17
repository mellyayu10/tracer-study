@php
    use Carbon\Carbon;
@endphp

@extends("pages.layouts.main")

@section("title", "Detail Data Rekomendasi Alumni")

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
                            <a href="{{ url('/alumni/dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ url('/alumni/rekomendasi') }}">
                                Rekomendasi Alumni
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Detail Rekomendasi Alumni
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="nama_perusahaan" class="form-label col-sm-2">
                            Nama Perusahaan :
                        </label>
                        <div class="col-md-10">
                            {{ $detail["nama_instansi"] }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_perusahaan" class="form-label col-sm-2">
                            Alamat Perusahaan :
                        </label>
                        <div class="col-md-10">
                            {{ $detail["alamat_instansi"] }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th>Alumni</th>
                                <th>Nomer HP</th>
                                <th class="text-center">Skala</th>
                                <th class="text-center">Profesi</th>
                                <th class="text-center">Penghasilan Tiap Bulan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_rekomendasi as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}.</td>
                                    <td>{{ $item["alumni"]["user"]["nama"] }}</td>
                                    <td>{{ $item["alumni"]["user"]["nomor_hp"] }}</td>
                                    <td class="text-center">{{ $item["skala"] }}</td>
                                    <td class="text-center">{{ $item["profesi"] }}</td>
                                    <td class="text-center">Rp. {{ number_format($item["penghasilan_tiap_bulan"]) }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center-{{ $item["id"] }}">
                                            <i class="fa fa-edit"></i> Detail
                                        </button>
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

<!-- Detail -->
@foreach ($data_rekomendasi as $item)
<div class="modal fade bs-example-modal-center-{{ $item["id"] }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    <i class="fa fa-search"></i> Detail Data
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="card-title">
                    Profil Atasan
                </h4>
                <table class="table table-bordered" style="width: 100%">
                    <tbody>
                        <tr>
                            <td>Nama Atasan</td>
                            <td>:</td>
                            <td>
                                {{ $item["pengguna_alumni"] }}
                            </td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>:</td>
                            <td>
                                {{ $item["divisi"] }}
                            </td>
                        </tr>
                        <tr>
                            <td>Nomor Telephone</td>
                            <td>:</td>
                            <td>
                                {{ $item["nomor_hp"] }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h4 class="card-title">
                    Detail Profil Pekerjaan
                </h4>
                <table class="table table-bordered" style="width: 100%">
                    <tbody>
                        <tr>
                            <td>Profesi</td>
                            <td>:</td>
                            <td>
                                {{ $item["profesi"] }}
                            </td>
                        </tr>
                        <tr>
                            <td>Periode Kerja Mulai</td>
                            <td>:</td>
                            <td>
                                {{ $item["periode_kerja_mulai"] }}
                            </td>
                        </tr>
                        <tr>
                            <td>Periode Kerja Akhir</td>
                            <td>:</td>
                            <td>
                                {{ $item["periode_kerja_akhir"] }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
