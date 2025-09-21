<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Asset Management - Register</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous">

    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Nunito', sans-serif;
        }

        .hero-image {
            background: linear-gradient(#b6e7e2b5, rgba(251, 251, 251, 1)), url("") center center / cover no-repeat;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero-text {
            width: 100%;
            max-width: 450px;
        }

        .card {
            background-color: rgba(3, 3, 40, 0.95);
            border-radius: 12px;
            color: white;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.6);
        }

        .card-header h5 {
            text-align: center;
            font-weight: 700;
            color: #fff;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn-register {
            width: 100%;
            border-radius: 8px;
            font-weight: 600;
            background-color: #00bfff;
            border: none;
            color: white;
        }

        .btn-register:hover {
            background-color: #009acd;
        }

        .text-center a {
            color: #00bfff;
        }

        @media (max-width: 576px) {
            .card {
                margin: 0 15px;
            }
        }
    </style>
</head>

<body>
    <div class="hero-image">
        <div class="hero-text">
            <div class="card">
                <div class="card-header">
                    <h5>Register Here</h5>
                </div>
                <div class="card-body">
                    <form class="user" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <input id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" placeholder="Email" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password" placeholder="Password" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" placeholder="Confirm Password" required>
                        </div>

                        <button type="submit" class="btn btn-register">Register</button>

                        <div class="text-center mt-3">
                            <span>Already have an account? </span>
                            <a href="{{ route('login') }}">Login here</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>