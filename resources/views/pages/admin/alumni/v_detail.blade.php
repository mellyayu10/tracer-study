@extends("pages.layouts.main")

@section("title", "Data Riwayat Pekerjaan " . $detail["user"]["nama"])

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
                            <a href="{{ url('/admin/data_alumni') }}">
                                Alumni
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Detail Riwayat
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <a href="{{ url('/admin/data_alumni') }}" class="btn btn-danger btn-sm">
        <i class="fa fa-times"></i> KEMBALI
    </a>
    
    <br><br>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <center>
                        @if (empty($detail["foto"]))
                        <img src="{{ url('/assets/images/empty-user.png') }}" class="img-responsive">    
                        @else
                        <img src="{{ url('/storage/'.$detail['foto']) }}" class="img-responsive" style="width: 150px; height: 150px;">
                        @endif
                    </center>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-md-3"> NIM </label>
                            <div class="col-md-7">
                                {{ $detail["nim"] }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-md-3"> Nama Lengkap </label>
                            <div class="col-md-7">
                                {{ $detail['user']["nama"] }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-md-3"> Prodi </label>
                            <div class="col-md-7">
                                {{ $detail["prodi"]['nama_prodi'] }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-md-3"> Jenis Kelamin </label>
                            <div class="col-md-7">
                                @if ($detail["jenis_kelamin"] == "L")
                                Laki - Laki
                                @elseif($detail["jenis_kelamin"] == "P")
                                Perempuan
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-md-3"> Tahun Masuk </label>
                            <div class="col-md-7">
                                @if ($detail["bulan_masuk"] == 1)
                                Januari
                                @elseif($detail["bulan_masuk"] == 2)
                                Februari
                                @elseif($detail["bulan_masuk"] == 3)
                                Maret
                                @elseif($detail["bulan_masuk"] == 4)
                                April
                                @elseif($detail["bulan_masuk"] == 5)
                                Mei
                                @elseif($detail["bulan_masuk"] == 6)
                                Juni
                                @elseif($detail["bulan_masuk"] == 7)
                                Juli
                                @elseif($detail["bulan_masuk"] == 8)
                                Agustus
                                @elseif($detail["bulan_masuk"] == 9)
                                September
                                @elseif($detail["bulan_masuk"] == 10)
                                Oktober
                                @elseif($detail["bulan_masuk"] == 11)
                                November
                                @elseif($detail["bulan_masuk"] == 12)
                                Desember
                                @endif
                                {{ $detail["tahun_masuk"] }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-md-3"> Tahun Lulus </label>
                            <div class="col-md-7">
                                @if ($detail["bulan_lulus"] == 1)
                                Januari
                                @elseif($detail["bulan_lulus"] == 2)
                                Februari
                                @elseif($detail["bulan_lulus"] == 3)
                                Maret
                                @elseif($detail["bulan_lulus"] == 4)
                                April
                                @elseif($detail["bulan_lulus"] == 5)
                                Mei
                                @elseif($detail["bulan_lulus"] == 6)
                                Juni
                                @elseif($detail["bulan_lulus"] == 7)
                                Juli
                                @elseif($detail["bulan_lulus"] == 8)
                                Agustus
                                @elseif($detail["bulan_lulus"] == 9)
                                September
                                @elseif($detail["bulan_lulus"] == 10)
                                Oktober
                                @elseif($detail["bulan_lulus"] == 11)
                                November
                                @elseif($detail["bulan_lulus"] == 12)
                                Desember
                                @endif
                                {{ $detail["tahun_lulus"] }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-md-3"> Alamat </label>
                            <div class="col-md-7">
                                {{ $detail["alamat"] }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-md-3"> Provinsi </label>
                            <div class="col-md-7">
                                {{ $detail["provinsi"] }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-md-3"> Kota/Kabupaten </label>
                            <div class="col-md-7">
                                {{ $detail["kota_kab"] }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-md-3"> Kecamatan </label>
                            <div class="col-md-7">
                                {{ $detail["kecamatan"] }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-md-3"> Kelurahan </label>
                            <div class="col-md-7">
                                {{ $detail["kelurahan"] }}
                            </div>
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
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Nama Instansi</th>
                                    <th>Alamat Instansi</th>
                                    <th>Provinsi</th>
                                    <th>Kota/Kab</th>
                                    <th>Kecamatan</th>
                                    <th>Kelurahan</th>
                                    <th class="text-center">Jabatan</th>
                                    <th class="text-center">Gaji</th>
                                    <th class="text-center">Tahun Masuk</th>
                                    <th class="text-center">Tahun Keluar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $nomer = 0
                                @endphp
                                @foreach ($riwayat as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}.</td>
                                    <td>{{ $item["nama_instansi"] }}</td>
                                    <td>{{ $item["alamat_instansi"] }}</td>
                                    <td>{{ $item["provinsi"] }}</td>
                                    <td>{{ $item["kota_kab"] }}</td>
                                    <td>{{ $item["kecamatan"] }}</td>
                                    <td>{{ $item["kelurahan"] }}</td>
                                    <td class="text-center">{{ $item["profesi"] }}</td>
                                    <td class="text-center">Rp. {{ number_format($item["penghasilan_tiap_bulan"]) }}</td>
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
    </div>
</div>

@endsection

@section("javascript")

<script src="{{ url('') }}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ url('') }}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ url('') }}/assets/js/pages/datatables.init.js"></script>

@endsection
