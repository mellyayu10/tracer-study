@php
    use Carbon\Carbon;
@endphp

@extends("pages.layouts.main")

@section("title", "Data Kuisioner Mahasiswa")

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
                            Kuisioner
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        
        @if (session("message"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-all me-2"></i>
            {!! session("message") !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close"></button>
        </div>
        @endif
        
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ url('/alumni/kuis_mahasiswa/create') }}" class="btn btn-primary btn-sm waves-effect waves-light">
                        <i class="fa fa-plus"></i> Tambah Data
                    </a>
                    <br><br>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">NIM</th>
                                <th>Nama</th>
                                <th class="text-center">Tanggal Isi Kuisioner</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kuisioner as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}.</td>
                                    <td class="text-center">{{ $item["alumni"]["nim"] }}</td>
                                    <td>{{ $item["alumni"]['user']['nama'] }}</td>
                                    <td class="text-center">
                                        @php
                                            $tanggal = Carbon::parse($item["tanggal_isi_kuis"]);
                                            $formated = $tanggal->isoFormat('D MMMM Y');
                                            echo $formated;
                                        @endphp
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url('/alumni/kuis_mahasiswa/'.$item["id"]) }}" class="btn btn-primary btn-sm waves-effect waves-light">
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

@endsection

@section("javascript")

<script src="{{ url('') }}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ url('') }}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ url('') }}/assets/js/pages/datatables.init.js"></script>

@endsection