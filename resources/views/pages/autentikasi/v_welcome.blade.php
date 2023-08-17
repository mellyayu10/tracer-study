<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>STUDY TRACER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        body {
            margin: 0px;
            padding: 0px;
            background-color: #CD5C5C;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row" style="justify-content: center; margin-top: 100px;">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <center>
                            <img src="{{ url('/assets/images/logo/logo-new.png') }}" style="width: 300px">
                            <hr>
                            <h5>
                                <strong>
                                    Silahkan Pilih Akun Login
                                </strong>
                            </h5>
                        </center>
                        <div class="row" style="justify-content: center; margin-top: 30px;">
                            <div class="col-md-6 mb-3">
                                <form action="{{ url('/login') }}">
                                    <input type="hidden" name="user" value="admin">
                                    <button class="btn btn-success btn-lg" style="width: 100%">
                                        ADMINISTRATOR
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form action="{{ url('/login') }}">
                                    <input type="hidden" name="user" value="alumni">
                                    <button class="btn btn-primary btn-lg" style="width: 100%">
                                        ALUMNI
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>