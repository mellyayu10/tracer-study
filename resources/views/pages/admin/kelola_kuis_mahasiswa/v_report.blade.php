@php
    use Illuminate\Support\Str;
    use App\Models\Alumni;
@endphp

@extends("pages.layouts.main")

@section("title", 'Laporan Kuisioner')

@section("css")

<link href="{{ url('') }}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('') }}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('') }}/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('') }}/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css">
<style type="text/css">
    .select2-container .select2-selection--single{
        height:30px !important;
    }
    table thead th{
        font-weight:bold;
    }
</style>

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
                            Laporan Kuisioner
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
                <form action="" method="POST" id="form-report">
                    @csrf
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-xl-6 ">
                                <div class="form-group">
                                    <label for="nama_soal" class="form-label">
                                        Kategori Kuisioner
                                    </label>
                                    <div class="col-md-7">
                                        <select name="nama_kategori_kuisioner" class="form-control @error("nama_kategori_kuisioner") {{ 'is-invalid' }} @enderror " id="nama_kategori_kuisioner">
                                            <option value="">- Pilih -</option>
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}" {{ old('nama_kategori_kuisioner') == $cat->id ? 'selected' : '' }} >
                                                    {{ $cat->nama_kategori_kuisioner }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="text-danger" id="alert-kategori">
                                        {{ $message ?? '' }}
                                    </span>
                                </div>
                                <div class="form-group mt-2">
                                    <label class="form-label">Nama Mahasiswa</label>
                                        <select name="nama_mahasiswa" class="form-control form-select2" id="nama_kategori_kuisioner">
                                            <option value="">- Semua -</option>
                                            @foreach ($mahasiswa as $mh)
                                                <option value="{{ $mh->id }}" {{ old('nama_mahasiswa') == $mh->id ? 'selected' : '' }} >
                                                    {{ $mh->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="form-group mt-2">
                                    <button type="reset" class="btn btn-danger btn-sm waves-effect">
                                        <i class="fa fa-times"></i> Batal
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm waves-effect" onclick="submitFormReport()">
                                        <i class="fa fa-save"></i> Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr>
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

                    <form target="_blank" action="{{ url('/admin/kelola_kuis/'.session("nama_kategori_kuisioner").'/download') }}">
                        <input type="hidden" name="nama_mahasiswa" value="{{ session("tahun") }}">
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-download"></i> Download
                        </button>
                    </form>

                    <br><br>
                    <h2>Kategori : {{session("kategori")->nama_kategori_kuisioner ?? '-'}}</h2>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Soal</th>
                                <th class="text-center">Jawaban</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (session("results") as $item)
                                <tr>
                                    <td colspan="2" style="background-color:#eee;">{{$item['nama_mahasiswa'] ?? '-'}}</td>
                                </tr>
                                @foreach($item['soal'] ?? [] as $key=>$soal)
                                @php
                                $soalModel = \App\Models\DetailKategoriKuisioner::whereSlug($key)->first();
                                @endphp
                                    <tr>
                                        <td>{{$soalModel->nama_soal ?? '-'}}</td>
                                        <td>{{$soal}}</td>
                                    </tr>
                                @endforeach
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

<script>
    $('.form-select2').select2();
    // $(document).ready(function() {
    //     getSoal();
    // });

    // function getSoal()
    // {
    //     var slug = $("#nama_kategori_kuisioner").val();
    //     let data = {
    //         nama_soal : '<?=old("nama_soal");?>',
    //         slug : slug
    //     }
    //     $.ajax({
    //         type: 'GET',
    //         data : data,
    //         url: "<?php echo url('admin/kelola_kuis/get-soal'); ?>",
    //         beforeSend: function() {

    //         },
    //         success: function(response) {
    //             $("#div-soal").html(response)
    //         }
    //     });
    // }

    function submitFormReport()
    {
        var kategori_soal = $("#nama_kategori_kuisioner");
        if(kategori_soal.val()=='')
        {
            $("#alert-kategori").html("Kolom Kategori Kuisioner Harus Diisi");

            kategori_soal.focus();

            setTimeout(function(){
                $("#alert-kategori").html("");
            },3000);

            return;
        }
        var slug = $("#nama_kategori_kuisioner").val();
        $("#form-report").attr("action", "{{url('admin/kelola_kuis')}}/"+slug);
        $("#form-report").submit();
    }
</script>

@endsection
