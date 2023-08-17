@php
use Illuminate\Support\Str;
use App\Models\PointPilihanTunggal;
@endphp

@extends("pages.layouts.main")

@section("title", "Laporan Kuisioner Pengguna Alumni")

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
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="point" class="form-label col-sm-2">
                                Point
                            </label>
                            <div class="col-md-7">
                                <select name="point" class="form-control @error("point") {{ 'is-invalid' }} @enderror " id="point">
                                    <option value="">- Pilih -</option>
                                    @foreach ($detail as $item)
                                    <option data-slug="{{ $item["slug"] }}" value="{{ $item["id"] }}" {{ old('point') == $item["id"] ? 'selected' : '' }} >{{ $item["nama_soal"] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error("point")
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label for="sub_point" class="form-label col-sm-2">
                                Sub Point
                            </label>
                            <div class="col-md-7">
                                <select name="sub_point" class="form-control @error("sub_point") {{ 'is-invalid' }} @enderror " id="sub_point">
                                    <option value="">- Pilih -</option>
                                </select>
                            </div>
                            @error("sub_point")
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
                        <input type="hidden" id="slug_input" name="slug_input" readonly>
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
                    <canvas id="myChart"></canvas>
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
                                <th>Nama Pengguna Alumni</th>
                                <th class="text-center">Divisi</th>
                                <th>Instansi</th>
                                <th class="text-center">Jawaban</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (session("results") as $item)
                            @if (is_array($item))
                            <tr>
                                <td>{{ $item["pekerjaan"]["pengguna_alumni"] }}</td>
                                <td class="text-center">{{ $item["pekerjaan"]["divisi"] }}</td>
                                <td>{{ $item["pekerjaan"]["nama_instansi"] }}</td>
                                <td class="text-center">
                                    @if ($item[session("slug")] == 1)
                                    Sangat Baik
                                    @elseif($item[session("slug")] == 2)
                                    Baik
                                    @elseif($item[session("slug")] == 3)
                                    Cukup
                                    @elseif($item[session("slug")] == 4)
                                    Kurang
                                    @endif
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    $(document).ready(function() {
        $('select[name="point"]').change(function() {
            let point = $(this).val();
            let pointName = $(this).find('option:selected').attr("data-slug");
            
            console.log(pointName);
            
            $.ajax({
                url: "{{ url('/get-parent') }}",
                type: "GET",
                data: {point:point},
                success: function(response) {
                    let subpoint = $("select[name='sub_point']");
                    subpoint.empty();
                    
                    if (response.length > 0) {
                        $.each(response, function(index, point_sub) {
                            subpoint.append('<option value="' + (index + 1) + '">' + point_sub.nama_point + '</option>');
                        });
                    } else {
                        subpoint.append('<option value="">Tidak Ada SubPoint</option>')
                    }
                    
                    let slugInput = $("#slug_input");
                    slugInput.val(pointName);
                },
                error: function() {
                    alert("Terjadi Kesalahan");
                }
            });
        }) 
    });
</script>
<script>
    const ctx = document.getElementById('myChart');
    
    const results = @json(session("results"));

    if (results.length > 0) {
        const labels = [];
        const dynamicProp = "{{ session("slug") }}";

        const cetak = results.map((item) => {
            if (item.hasOwnProperty(dynamicProp)) {
                if (item[dynamicProp] == 1) {
                    labels.push("Sangat Baik");
                } else if (item[dynamicProp] == 2) {
                    labels.push("Baik");
                } else if (item[dynamicProp] == 3) {
                    labels.push("Cukup");
                } else if (item[dynamicProp] == 4) {
                    labels.push("Kurang");
                }
                console.log(item[dynamicProp]);
                return item[dynamicProp];
            }
        }).filter((item) => item !== undefined);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Hasil Tracer Study',
                    data: cetak,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    }

</script>

@endsection
