@extends("pages.layouts.main")

@section("title", "Data Daftar Rekomendasi")

@section("css")

<link href="{{ url('') }}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
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
                            Daftar Rekomendasi
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
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th>Nama Alumni</th>
                                <th class="text-center">Nomer HP</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rekomendasi as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}.</td>
                                <td>{{ $item["nama"] }}</td>
                                <td class="text-center">{{ $item["nomer_hp"] }}</td>
                                <td class="text-center">
                                    @if ($item["status"] == "0")
                                    <form action="{{ url('/admin/kelola_pekerjaan/'.$item['id'].'/ditolak') }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method("PUT")
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Ditolak
                                        </button>
                                    </form>
                                    <form action="{{ url('/admin/kelola_pekerjaan/'.$item['id'].'/diterima') }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method("PUT")
                                        <button type="submit" class="btn btn-success btn-sm">
                                            Diterima
                                        </button>
                                    </form>
                                    @elseif($item["status"] == "1")
                                    <button class="btn btn-primary btn-sm">
                                        Sudah Ditindak Lanjuti
                                    </button>
                                    @elseif($item["status"] == "2")
                                    <button class="btn btn-danger btn-sm">
                                        Ditolak 
                                    </button>
                                    @endif
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

<!-- Update Data -->
@foreach ($rekomendasi as $item)
<div class="modal fade bs-example-modal-center-{{ $item["id"] }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    <i class="fa fa-edit"></i> Update Data Alumni
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <form action="{{ url('/admin/kelola_pekerjaan/'.$item->id.'/update') }}" method="POST">
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <div class="form-group">
                        <label for="alumni_id"> Cari Data Alumni </label>
                        <select name="alumni_id" class="form-control js-example-basic-single @error("alumni_id") {{ 'is-invalid' }} @enderror" id="alumni_id">
                            <option value="">- Pilih -</option>
                            @foreach ($alumni as $item)
                            <option value="{{ $item["id"] }}">
                                {{ $item["nim"] }} - {{ $item["user"]["nama"] }} - {{ $item["tahun_lulus"] }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @error("nama_kategori_kuisioner")
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                    @enderror
                    
                    <br>
                    
                    <div class="form-group">
                        <label for="nomer_hp"> Nomer HP </label>
                        <input type="text" class="form-control @error("nomer_hp") {{ 'is-invalid' }} @enderror" name="nomer_hp" id="nomer_hp" placeholder="Masukkan Nomer HP" value="{{ old('nomer_hp') }}">
                    </div>
                    @error("nomer_hp")
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger btn-sm">
                        <i class="fa fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<!-- END -->

@endsection

@section("javascript")

<script src="{{ url('') }}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ url('') }}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ url('') }}/assets/js/pages/datatables.init.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>

@endsection
