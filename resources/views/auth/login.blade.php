<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; {{ config('app.name') }}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/components.css') }}">
</head>

<body>
    @if (session('success'))
        <div class="alert alert-success bg-green-500 text-white px-4 py-3 rounded shadow-lg fade-alert">
            {{ session('success') }}
        </div>
    @endif

    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                        class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <strong class="text-primary">{{ config('app.name') }}</strong>
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>{{ __('Login') }}</h4>
                            </div>
                            @error('gagal')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="username">{{ __('Username atau E-Mail') }}</label>
                                        <input id="username" type="text"
                                            class="form-control @error('username') is-invalid @enderror "
                                            name="username" value="{{ old('username') }}" tabindex="1" autofocus>
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">{{ __('Password') }}</label>
                                        </div>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            tabindex="2">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="remember" class="custom-control-input"
                                                tabindex="3" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label"
                                                for="remember">{{ __('Remember Me') }}</label>
                                        </div>
                                    </div>

                                    <div class="form-group d-grid gap-2">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            <i class="fas fa-sign-in-alt"></i> {{ __('Login') }}
                                        </button>

                                        <a href="{{ route('register') }}"
                                            class="btn btn-outline-primary btn-lg btn-block">
                                            <i class="fas fa-user-plus"></i> {{ __('Daftar Akun') }}
                                        </a>

                                        <a href="{{ route('pengguna.dashboard') }}"
                                            class="btn btn-secondary btn-lg btn-block" tabindex="5">
                                            <i class="fas fa-arrow-left"></i> {{ __('Kembali') }}
                                        </a>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; 2024 {{ config('app.name') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <!-- General JS Scripts -->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/popper/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/moment/moment.min.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="{{ asset('assets/admin/js/stisla.js') }}"></script>
    <script src="{{ asset('assets/admin/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/admin/js/custom.js') }}"></script>

    <!-- Page Specific JS File -->

    <style>
        .fade-alert {
            animation: fadeOut 0.5s ease-in-out 3s forwards;
        }

        @keyframes fadeOut {
            to {
                opacity: 0;
                transform: translateY(-10px);
                visibility: hidden;
            }
        }
    </style>


</body>

</html>
