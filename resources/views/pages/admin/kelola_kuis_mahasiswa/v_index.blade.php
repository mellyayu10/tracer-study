@php
    use Illuminate\Support\Str;
    use App\Models\Alumni;
@endphp

@extends("pages.layouts.main")

@section("title", $kategori["nama_kategori_kuisioner"])

@section("css")

<link href="{{ url('') }}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('') }}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('') }}/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('') }}/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css">

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
                            {{ $kategori["nama_kategori_kuisioner"] }}
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
                <form action="" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="nama_soal" class="form-label col-sm-2">
                                Nama Soal
                            </label>
                            <div class="col-md-7">
                                <select name="nama_soal" class="form-control @error("nama_soal") {{ 'is-invalid' }} @enderror " id="nama_soal">
                                    <option value="">- Pilih -</option>
                                    @foreach ($detail as $item)
                                        <option value="{{ $item["slug"] }}" {{ old('nama_soal') == $item["slug"] ? 'selected' : '' }} >
                                            {{ $item["nama_soal"] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error("nama_soal")
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label for="tahun_pengisian" class="form-label col-sm-2">
                                Tahun Pengisian
                            </label>
                            <div class="col-md-7">
                                <input type="year" class="form-control @error("tahun_pengisian") {{ 'is-invalid' }} @enderror " name="tahun_pengisian" id="tahun_pengisian" value="{{ old('tahun_pengisian') }}">
                            </div>
                            @error("tahun_pengisian")
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <hr>
                        <button type="reset" class="btn btn-danger btn-sm waves-effect">
                            <i class="fa fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm waves-effect">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    @if (empty(session("results")))
        
    @else
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <form target="_blank" action="{{ url('/admin/kelola_kuis/'.session("slug").'/download') }}">
                        <input type="hidden" name="slug_download" value="{{ session("slug") }}">
                        <input type="hidden" name="tahun_download" value="{{ session("tahun") }}">
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-download"></i> Download
                        </button>
                    </form>

                    <br><br>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            @php
                                $text = Str::title(str_replace('-', ' ', session("slug")));
                            @endphp
                            <tr>
                                <th>Alumni</th>
                                <th class="text-center">Nomor HP</th>
                                <th style="text-transform: uppercase">{{ Str::limit($text, 80) }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (session("results") as $item)
                                @php
                                    $nomer = 1;
                                @endphp
                                @if (is_array($item) && isset($item[session("slug")]) )
                                <tr>
                                    <td>
                                        @if (isset($item["alumni_id"]))
                                            {{ \App\Models\Alumni::find($item["alumni_id"])["user"]["nama"] }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if (isset($item["alumni_id"]))
                                            {{ \App\Models\Alumni::find($item["alumni_id"])["user"]["nomor_hp"] }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ $item[session("slug")] }}
                                    </td>
                                </tr>    
                                @else

                                @endif
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

<script src="{{ url('') }}/assets/libs/select2/js/select2.min.js"></script>
<script src="{{ url('') }}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ url('') }}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ url('') }}/assets/js/pages/datatables.init.js"></script>

@endsection
