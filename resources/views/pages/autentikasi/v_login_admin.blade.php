
<!doctype html>
<html lang="en">

<head>
    
    <meta charset="utf-8" />
    <title>Login | Study Tracer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="{{ url('') }}/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ url('') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('') }}/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    
</head>

<body class="auth-body-bg">
    <div class="home-btn d-none d-sm-block">
        <a href="index.html"></a>
    </div>
    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <a href="{{ url('/') }}" class="btn btn-danger" style="width: 100%">
                        KEMBALI
                    </a>
                    <br><br>
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mt-4">
                                <div class="mb-3">
                                    <a href="index.html" class="">
                                        <img src="{{ url('/assets/images/logo/logo-new.png') }}" height="100" width="300" class="auth-logo logo-dark mx-auto">
                                    </a>
                                </div>
                            </div>
                            <div class="p-3">
                                <h4 class="font-size-18 text-muted mt-2 text-center">
                                    Selamat Datang !
                                </h4>
                                <p class="text-muted text-center mb-4">
                                    Silahkan Login Terlebih Dahulu
                                </p>
                                
                                <form class="form-horizontal" action="{{ url('/login') }}" method="POST">
                                    @csrf
                                    <div class="mb-1">
                                        <label class="form-label" for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" value="{{ old('username') }}">
                                    </div>
                                    @error("username")
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                    
                                    <div class="mb-1">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">
                                    </div>
                                    @error("password")
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror

                                    <hr>
                                    
                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">
                                            Log In
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ url('') }}/assets/libs/jquery/jquery.min.js"></script>
    <script src="{{ url('') }}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('') }}/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="{{ url('') }}/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ url('') }}/assets/libs/node-waves/waves.min.js"></script>
    
    <script src="{{ url('') }}/assets/js/app.js"></script>
    
</body>

</html>