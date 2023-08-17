@extends("pages.layouts.main")

@section("title", "Data Detail Instansi")

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
                            <a href="{{ url('/admin/instansi') }}">
                                Instansi
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Detail Instansi
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ url('/admin/instansi') }}" class="btn btn-danger btn-sm">
        <i class="fa fa-times"></i> KEMBALI
    </a>

    <br><br>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th>Nama</th>
                                <th class="text-center">Tahun Masuk</th>
                                <th class="text-center">Tahun Keluar</th>
                                <th>Nama Atasan</th>
                                <th class="text-center">Jabatan</th>
                                <th class="text-center">Gaji</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detail as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}.</td>
                                    <td>{{ $item["alumni"]['user']['nama'] }}</td>
                                    <td class="text-center">{{ $item["periode_kerja_mulai"] }}</td>
                                    <td class="text-center">{{ $item["periode_kerja_akhir"] }}</td>
                                    <td>{{ $item["pengguna_alumni"] }}</td>
                                    <td class="text-center">{{ $item["profesi"] }}</td>
                                    <td class="text-center">Rp. {{ number_format($item["penghasilan_tiap_bulan"]) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section("javascript")

<script src="{{ url('') }}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ url('') }}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ url('') }}/assets/js/pages/datatables.init.js"></script>

@endsection
