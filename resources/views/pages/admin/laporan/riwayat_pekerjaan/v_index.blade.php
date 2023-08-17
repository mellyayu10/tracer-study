@extends("pages.layouts.main")

@section("title", "Data Laporan Pekerjaan")

@section("css")

<link href="{{ url('') }}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('') }}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('') }}/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('') }}/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
                            @yield("title")
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
                <form action="" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="nama_instansi" class="col-sm-2 col-form-label"> Cari Nama PT </label>
                            <div class="col-sm-10">
                                <select name="nama_instansi" class="form-control js-example-basic-single @error("nama_instansi") {{ 'is-invalid' }} @enderror " id="nama_instansi">
                                    <option value="">- Pilih -</option>
                                    @foreach ($riwayat_pekerjaan as $item)
                                    <option value="{{ $item["nama_instansi"] }}" {{ old('nama_instansi') == $item["nama_instansi"] ? 'selected' : '' }}>
                                        {{ $item["nama_instansi"] }} - {{ $item["alamat_instansi"] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @error("nama_instansi")
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label for="tahun" class="col-sm-2 col-form-label"> Tahun Mulai Kerja </label>
                            <div class="col-sm-10">
                                <input type="year" class="form-control @error("tahun") {{ 'is-invalid' }} @enderror " name="tahun" id="tahun" placeholder="2023" value="{{ old('tahun') }}">
                            </div>
                            @error("tahun")
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <hr>
                        <div class="form-group">
                            <button type="reset" class="btn btn-danger btn-sm waves-effect">
                                <i class="fa fa-times"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-primary btn-sm waves-effect">
                                <i class="fa fa-search"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    @if (empty(session("search")))
    
    @else
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('/admin/laporan/pekerjaan/download') }}" method="POST">
                        @csrf
                        <input type="hidden" name="session_data" value="{{ json_encode(session("search")) }}">
                        <button type="submit" class="btn btn-danger btn-sm waves-effect">
                            <i class="fa fa-download"></i> Download PDF
                        </button>
                    </form>
                    <br><br>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th>Alumni</th>
                                <th class="text-center">Penghasilan PerBulan</th>
                                <th>Profesi</th>
                                <th class="text-center">Periode Kerja Mulai</th>
                                <th class="text-center">Periode Kerja Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (session("search") as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}.</td>
                                <td>{{ $item["alumni"]["user"]["nama"] }}</td>
                                <td class="text-center">Rp. {{ number_format($item["penghasilan_tiap_bulan"]) }} </td>
                                <td>{{ $item["profesi"] }}</td>
                                <td class="text-center">{{ $item["periode_kerja_mulai"] }}</td>
                                <td class="text-center">{{ $item["periode_kerja_akhir"] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
    
</div>

@endsection

@section("javascript")

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ url('') }}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ url('') }}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ url('') }}/assets/js/pages/datatables.init.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>

@endsection
