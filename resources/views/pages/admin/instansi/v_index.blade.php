@extends("pages.layouts.main")

@section("title", "Data Instansi")

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
                        <li class="breadcrumb-item active">
                            Instansi
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
                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center">
                        <i class="fa fa-plus"></i> Tambah Data
                    </button>
                    <br><br>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered table-striped dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Nama Instansi</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($instansi as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}.</td>
                                        <td>{{ $item["nama_instansi"] }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-warning btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center-edit-{{ $item["id"] }}">
                                                <i class="fa fa-edit"></i> Edit
                                            </button>
                                            <form action="{{ url('/admin/instansi/'.$item["id"]) }}" method="POST" style="display: inline">
                                                @csrf
                                                @method("DELETE")
                                                <button onclick="return confirm('Yakin ? Anda Ingin Menghapus Data Ini ?')" type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        <a href="{{ url('/admin/instansi/'.$item["id"]) }}" class="btn btn-info btn-sm">
                                                <i class="fa fa-search"></i> Detail
                                            </a>
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
</div>

<!-- Tambah Data -->
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">
                    <i class="fa fa-plus"></i> Tambah Data
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
            </div>
            <form action="{{ url('/admin/instansi') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_instansi"> Nama Instansi </label>
                        <input type="text" class="form-control @error("nama_instansi") {{ 'is-invalid' }} @enderror " name="nama_instansi" id="nama_instansi" placeholder="Masukkan Nama Instansi" value="{{ old("nama_instansi") }}">
                    </div>
                    @error("nama_instansi")
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror

                    <br>
                    
                    <div class="form-group">
                        <label for="provinsi"> Provinsi </label>
                        <select name="provinsi" class="form-control @error("provinsi") {{ 'is-invalid' }} @enderror " id="provinsi">
                            <option value="">- Pilih -</option>
                            @foreach ($provinsi as $item)
                                <option value="{{ $item["id"] }}">
                                    {{ $item["name"] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @error("provinsi")
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror

                    <br>
                    
                    <div class="form-group">
                        <label for="kota_kab"> Kota Kabupaten </label>
                        <select name="kota_kab" class="form-control @error("kota_kab") {{ 'is-invalid' }} @enderror " id="kota_kab">
                            <option value="">- Pilih Kota Kabupaten -</option>
                            
                        </select>
                    </div>
                    
                    @error("kota_kab")
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror

                    <br>
                    
                    <div class="form-group">
                        <label for="kecamatan"> Kecamatan </label>
                        <select name="kecamatan" class="form-control @error("kecamatan") {{ 'is-invalid' }} @enderror " id="kecamatan">
                            <option value="">- Pilih Kecamatan -</option>
                            
                        </select>
                    </div>
                    
                    @error("kecamatan")
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror

                    <br>
                    
                    <div class="form-group">
                        <label for="kelurahan"> Kelurahan </label>
                        <select name="kelurahan" class="form-control @error("kelurahan") {{ 'is-invalid' }} @enderror " id="kelurahan">
                            <option value="">- Pilih Kelurahan -</option>
                            
                        </select>
                    </div>
                    
                    @error("kelurahan")
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror

                    <br>
                    
                    <div class="form-group">
                        <label for="alamat"> Alamat </label>
                        <textarea name="alamat" class="form-control" id="alamat"  rows="5" placeholder="Masukkan Alamat">{{ old('alamat') }}</textarea>
                    </div>
                    
                    @error("alamat")
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-danger btn-sm">
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
<!-- END -->

@include('pages.admin.instansi.modal.edit')

@endsection

@section("javascript")

<script src="{{ url('') }}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ url('') }}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ url('') }}/assets/js/pages/datatables.init.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#provinsi").change(function() {
            let provinsi = $(this).val();

            $.ajax({
                url: "{{ url('/admin/wilayah/ambil_kota_kab') }}",
                type: "GET",
                data: { provinsi: provinsi },
                success: function(res) {
                    $("#kota_kab").html(res);
                }
            });
        });

        $("#kota_kab").change(function() {
            let kota_kab = $("#kota_kab").val();

            $.ajax({
                url: "{{ url('/admin/wilayah/ambil_kecamatan') }}",
                type: "GET",
                data: { kota_kab: kota_kab },
                success: function(res) {
                    $("#kecamatan").html(res);
                }
            });
        });

        $("#kecamatan").change(function() {
            let kecamatan = $("#kecamatan").val();

            $.ajax({
                url: "{{ url('/admin/wilayah/ambil_kelurahan') }}",
                type: "GET",
                data: { kecamatan: kecamatan },
                success: function(res) {
                    $("#kelurahan").html(res);
                }
            });
        });
    });
</script>
@endsection
