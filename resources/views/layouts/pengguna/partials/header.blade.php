{{-- Navbar --}}
<header id="header" class="fixed-top no-print shadow-sm bg-white">
    <div class="container d-flex align-items-center justify-content-between py-2">

        <!-- Logo -->
        <h1 class="logo m-0">
            <a href="{{ route('pengguna.dashboard') }}" class="text-dark text-decoration-none fw-bold fs-4">
                {{ Str::upper(config('app.name')) }}
            </a>
        </h1>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light p-0">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-3">

                    <li class="nav-item">
                        <a class="nav-link px-3 {{ request()->routeIs('pengguna.dashboard') ? 'active fw-bold text-primary' : 'text-dark' }}"
                            href="{{ route('pengguna.dashboard') }}">Home</a>
                    </li>

                    @auth
                        <li class="nav-item">
                            <a class="nav-link px-3 {{ request()->routeIs('pengguna.diagnosa.index') ? 'active fw-bold text-primary' : 'text-dark' }}"
                                href="{{ route('pengguna.diagnosa.index') }}">Identifikasi</a>
                        </li>
                    @endauth

                    {{-- <li class="nav-item">
                        <a class="nav-link px-3 {{ request()->routeIs('pengguna.penyakit.index') ? 'active fw-bold text-primary' : 'text-dark' }}"
                            href="{{ route('pengguna.penyakit.index') }}">
                            Info Perilaku Judi Online
                        </a>
                    </li> --}}
                    {{-- 
                    <li class="nav-item">
                        <a class="nav-link px-3 {{ request()->routeIs('pengguna.pesan.index') ? 'active fw-bold text-primary' : 'text-dark' }}"
                            href="{{ route('pengguna.pesan.index') }}">Pesan</a>
                    </li> --}}

                    @auth
                        <!-- User Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-2 fs-5"></i> Profil
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="userDropdown">
                                @if (in_array(Auth::user()->role, ['admin', 'psikologi', 'asisten1', 'asisten2']))
                                    <li>
                                        <a href="{{ auth()->user()->role === 'pasien' ? route('admin.diagnosa.index') : route('admin.dashboard') }}"
                                            class="dropdown-item">
                                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}" class="dropdown-item text-danger"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Hidden Logout Form -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @else
                        <li class="nav-item d-flex gap-2">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill px-4 py-2">
                                Login
                            </a>
                            {{-- <a href="{{ route('register') }}" class="btn btn-primary rounded-pill px-4 py-2">
                                Register
                            </a> --}}
                        </li>
                    @endauth

                </ul>
            </div>
        </nav>
    </div>
</header>

<!-- Bootstrap Icons & JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
