@php
    use App\Models\Alumni;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pekerjaan</title>

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
    </style>

</head>
<body>
    
    <div class="info_judul">
        <div class="title_satu">
            Laporan Pekerjaan
        </div>
    </div>

    <br>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%">
        <thead style="background-color: green; color:white">
            <tr>
                <th class="tengah">No.</th>
                <th style="text-align: left">Nama</th>
                <th style="text-align: left;">Profesi</th>
                <th>Instansi</th>
                <th class="tengah">Penghasilan Perbulan</th>
                <th class="tengah">Periode Mulai Bekerja</th>
                <th class="tengah">Periode Akhir Bekerja</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $dt)
                @php
                    $alumni = Alumni::where("id", $dt["alumni_id"])->first();
                @endphp
            <tr>
                <td class="tengah">{{ $loop->iteration }}.</td>
                <td>{{ $alumni["user"]["nama"] }}</td>
                <td>{{ $dt["profesi"] }}</td>
                <td>{{ $dt["nama_instansi"] }}</td>
                <td class="tengah">Rp. {{ number_format($dt["penghasilan_tiap_bulan"]) }}</td>
                <td class="tengah">{{ $dt["periode_kerja_mulai"] }}</td>
                <td class="tengah">{{ $dt["periode_kerja_akhir"] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>