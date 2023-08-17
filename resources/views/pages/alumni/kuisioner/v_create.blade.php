@php
use App\Models\DetailKategoriKuisioner;
use App\Models\PointPilihanTunggal;
use App\Models\PointPilihanGanda;
@endphp

@extends("pages.layouts.main")

@section("title", "Tambah Data Kuisioner Alumni")

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
                            <a href="{{ url('/admin/kuisioner') }}">
                                Kuisioner Alumni
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Tambah Kuisioner
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
    
    <div class="alert alert-success" role="alert">
        <i class="mdi mdi-check-all me-2"></i>
        Harap Isi Kuisioner Dengan Fakta Lapangan
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="fa fa-plus"></i> Tambah Data
                    </h4>
                </div>
                <form action="{{ url('/alumni/kuis_mahasiswa/store/'.$id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="alumni_id" value="{{ Auth::user()->alumni->id }}">
                    <div class="card-body">
                        @foreach ($kategori_kuisioner as $item)
                        @php
                        $detail = DetailKategoriKuisioner::where("kategori_kuisioner_id", $item["id"])->get();
                        @endphp
                        <h4 class="card-title">
                            {{ $item["nama_kategori_kuisioner"] }}
                        </h4>
                        <hr>
                        @foreach ($detail as $data)
                        @if ($data["tipe_soal"] == 1)
                        <div class="form-group mt-1 mb-2">
                            <label class="form-label"> {{ $data["nama_soal"] }} </label>
                            <input type="text" class="form-control @error($data["slug"]) {{ 'is-invalid' }} @enderror " name={{ $data["slug"] }} placeholder="Silahkan Diisi" value="{{ old($data["slug"]) }}" >
                        </div>
                        @error($data["slug"])
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                        @enderror
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
                                <input type="radio" required name="{{ $data["slug"] }}_{{ $loop->iteration }}" value="1"> Sangat Besar &nbsp;
                                <input type="radio" required name="{{ $data["slug"] }}_{{ $loop->iteration }}" value="2"> Besar || &nbsp;
                                <input type="radio" required name="{{ $data["slug"] }}_{{ $loop->iteration }}" value="3"> Cukup Besar || &nbsp;
                                <input type="radio" required name="{{ $data["slug"] }}_{{ $loop->iteration }}" value="4"> Kurang || &nbsp;
                                <input type="radio" required name="{{ $data["slug"] }}_{{ $loop->iteration }}" value="5"> Tidak Sama Sekali
                            </div>
                            @endif
                            @endforeach    
                            @else
                            <select name={{ $data["slug"] }} class="form-control @error($data["slug"]) {{ 'is-invalid' }} @enderror" id={{ $data["slug"] }}>
                                <option value="">- Pilih -</option>
                                @foreach ($data_point as $point)
                                <option value="{{ $point["nama_point"] }}" {{ old($data["slug"]) == $point["id"] ? 'selected' : '' }} >
                                    {{ $point["nama_point"] }}
                                </option>
                                @endforeach
                            </select>
                            @error($data["slug"])
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                            @enderror
                            @endif
                        </div>
                        @endif
                        @endforeach
                        @endforeach
                    </div>
                    <div class="card-footer">
                        <button type="reset" class="btn btn-danger btn-sm waves-effect waves-light">
                            <i class="fa fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script>
    // Mengambil semua checkbox dengan nama yang diawali "pilihan-"
    const checkboxes = document.querySelectorAll('input[name^="pilihan-"]');
    const validationMessage = document.createElement('div');
    validationMessage.textContent = 'Pilih minimal satu opsi.';
    validationMessage.style.color = 'red';
    validationMessage.style.display = 'none';

    // Memasukkan pesan validasi ke dalam elemen form
    const formGroup = document.querySelector('.form-group');
    formGroup.appendChild(validationMessage);

    // Menambahkan event listener untuk memeriksa validasi saat tombol submit ditekan
    const submitButton = document.querySelector('button[type="submit"]');
    submitButton.addEventListener('click', function(e) {
        let checked = false;
        checkboxes.forEach((checkbox) => {
            if (checkbox.checked) {
                checked = true;
            }
        });

        if (!checked) {
            validationMessage.style.display = 'block';
            e.preventDefault(); // Mencegah pengiriman formulir jika validasi gagal
        } else {
            validationMessage.style.display = 'none';
        }
    });
</script>
@endsection