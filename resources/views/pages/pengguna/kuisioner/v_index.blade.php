@php
use App\Models\DetailKategoriKuisioner;
use App\Models\PointPilihanTunggal;
use App\Models\PointPilihanGanda;
@endphp

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kuisioner Alumni {{ $detail["alumni"]["user"]["nama"] }} </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>
<body>
    
    <nav class="navbar bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ url('/assets/images/logo/logo.jpg') }}" alt="Logo" width="150" height="80" class="d-inline-block align-text-top">
            </a>
        </div>
    </nav>

    <div class="container pt-3 pb-3">
        <h5 class="card-title">
            Data Alumni
        </h5>
        <hr>
        <div class="row">
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label class="form-label"> Nama Alumni </label>
                    <input type="text" class="form-control" value="{{ $detail["alumni"]["user"]["nama"] }}" disabled>
                </div>
            </div>
            <div class="col-md-6 mb-2">
                <div class="form-group">
                    <label class="form-label"> Nomor HP Alumni </label>
                    <input type="text" class="form-control" value="{{ $detail["alumni"]["user"]["nomor_hp"] }}" disabled>
                </div>
            </div>
        </div>
        
        <br>
        
        <form action="{{ url('/pengguna_alumni/'.$detail['id']) }}" method="POST">
            @csrf
            <div class="card-body">
                @foreach ($kuis_user as $item)
                    @php
                        $detail = DetailKategoriKuisioner::where("kategori_kuisioner_id", $item["id"])->get();
                    @endphp
                    <strong style="font-size: 20px;">
                        {{ $item["nama_kategori_kuisioner"] }}
                    </strong>
                    @foreach ($detail as $data)
                        @if ($data["tipe_soal"] == 1)
                        <div class="form-group mt-1 mb-2">
                            <label class="form-label"> {{ $data["nama_soal"] }} </label>
                            <input type="text" class="form-control" name={{ $data["slug"] }} placeholder="Silahkan Diisi">
                        </div>    
                        @elseif($data["tipe_soal"] == 2)
                        @php
                        $data_point = PointPilihanGanda::where("detail_kategori_kuisioner_id", $data["id"])->get();
                        @endphp
                        <div class="form-group mt-1 mb-2">
                            <label class="form-label">
                                {{ $data["nama_soal"] }}
                            </label>
                            <div class="form-check mb-3">
                                @foreach ($data_point as $point_ganda)
                                <input type="checkbox" class="form-check-input" name="pilihan-{{ $point_ganda["detail_kategori_kuisioner"]["slug"] }}[]" value="{{ $point_ganda["nama_point"] }}">
                                <label for="" class="form-check-label">
                                    {{ $point_ganda["nama_point"] }}
                                </label>
                                <br>
                                @endforeach
                            </div>
                        </div>
                        @elseif($data["tipe_soal"] == 3)
                        @php
                        $data_point = PointPilihanTunggal::where("detail_kategori_kuisioner_id", $data["id"])->get();
                    @endphp
                    <div class="form-group mt-1 mb-2">
                        <label for="form-label"> {{ $data["nama_soal"] }} </label>
                        
                        @if ($data_point->where("is_child", 1)->count() > 0)
                            @foreach ($data_point as $item)
                                @if ($item["is_child"] == 1)
                                    <div style="margin-bottom: 10px;">
                                        <strong style="text-transform: uppercase"> 
                                            {{ $item["nama_point"] }}
                                        </strong>
                                        <br>
                                        <input type="radio" name="{{ $data["slug"] }}_{{ $loop->iteration }}" value="1"> Sangat Baik &nbsp;
                                        <input type="radio" name="{{ $data["slug"] }}_{{ $loop->iteration }}" value="2"> Baik || &nbsp;
                                        <input type="radio" name="{{ $data["slug"] }}_{{ $loop->iteration }}" value="3"> Cukup || &nbsp;
                                        <input type="radio" name="{{ $data["slug"] }}_{{ $loop->iteration }}" value="4"> Kurang
                                    </div>
                                @endif
                            @endforeach    
                        @else
                        <select name={{ $data["slug"] }} class="form-control" id={{ $data["slug"] }}>
                            <option value="">- Pilih -</option>
                            @foreach ($data_point as $point)
                            <option value="{{ $point["id"] }}">
                                {{ $point["nama_point"] }}
                            </option>
                            @endforeach
                        </select>
                        @endif
                    </div>
                        @endif
                    @endforeach
                    <hr>
                @endforeach
            </div>
            <div class="card-footer">
                <button type="reset" class="btn btn-danger btn-sm">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary btn-sm">
                    Simpan
                </button>
            </div>
        </form>


    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>