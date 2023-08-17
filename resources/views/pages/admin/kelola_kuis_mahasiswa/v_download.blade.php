@php
use App\Models\Alumni;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Kuisioner Alumni</title>
    
    <style>
        body {
            margin: 0px;
            padding: 0px;
            font-family: 'Montserrat', sans-serif;
        }
        
        .info_judul {
            text-align: center;
        }
        
        .title_satu {
            font-size: 30px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .tengah {
            text-align: center;
        }
        table tr td{
            padding:10px;
        }
        table thead tr th{
            padding:10px;
        }
        .subtitle-kategori{
            margin-bottom:20px;
            margin-top:10px;
            font-weight:bold;
            font-size:16px;
        }
    </style>
    
</head>
<body>
    
    <div class="info_judul">
        <div class="title_satu">
            Laporan Kuisioner Alumni
        </div>
    </div>
    
    <br>
    <div class="subtitle-kategori">
        Kategori : {{$kategori->nama_kategori_kuisioner ?? '-'}}
    </div>
    <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; margin-top:20px;">
        <thead>
            <tr>
                <th>Soal</th>
                <th class="text-center">Jawaban</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $item)
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
    
</body>
</html>
