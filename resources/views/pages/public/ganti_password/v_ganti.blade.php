@extends("pages.layouts.main")

@section("title", "Ganti Password")

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
                            <a href="{{ url('/alumni/dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Password
                        </li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                @if (Auth::user()->akses == "admin")
                <form action="{{ url('/admin/ganti_password') }}" method="POST">
                @elseif(Auth::user()->akses == "alumni")
                <form action="{{ url('/alumni/ganti_password') }}" method="POST">
                @endif
                    @csrf
                    @method("PUT")
                    <div class="card-body">
                        <div class="form-group">
                            <label for="password_baru"> Password Baru </label>
                            <input type="password" class="form-control @error("password_baru") {{ 'is-invalid' }} @enderror " name="password_baru" id="password_baru" placeholder="Masukkan Password Baru Anda">
                            @error("password_baru")
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="konfirmasi_password"> Konfirmasi Password </label>
                            <input type="password" class="form-control @error("konfirmasi_password") {{ 'is-invalid' }}  @enderror" name="konfirmasi_password" id="konfirmasi_password" placeholder="Konfirmasi Password Anda">
                            @error("konfirmasi_password")
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
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
</div>

@endsection
