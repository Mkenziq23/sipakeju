<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}">
            <ion-icon name="shield-half-outline"></ion-icon> {{ config('app.name') }}
        </a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ route('admin.dashboard') }}">PB</a>
    </div>
    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('pengguna.dashboard') }}" class="nav-link"><i class="fas fa-home"></i><span>Home
                    Page</span></a>
        </li>
        <li class="menu-header">Dashboard</li>
        <li class="{{ $title == 'Dashboard' ? ' active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                    class="fas fa-home"></i><span>Dashboard</span></a>
        </li>
        {{-- <li class="nav-item dropdown">
        <li class="nav-item dropdown{{ $title == 'Dashboard' ? ' active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-home"></i><span>Dashboard</span></a>
            <ul class="dropdown-menu" style="display: none;">
                <li><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
                <li><a class="nav-link" href="{{ route('pengguna.dashboard') }}">Dashboard Pengguna</a></li>
            </ul>
        </li> --}}
        {{-- <li class="{{ $title == 'Dashboard' ? 'active' : ''}}">
      <a href="{{route('admin.dashboard')}}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
    </li> --}}
        <li class="menu-header">Analitic</li>
        <li class="{{ $title == 'Pernyataan Kecenderungan Perilaku Judi Online' ? 'active' : '' }}">
            <a href="{{ route('admin.gejala.index') }}" class="nav-link"><i
                    class="fas fa-plus-square"></i><span>Pernyataan</span></a>
        </li>
        <li class="{{ $title == 'Tingkat Kecenderungan Perilaku Judi Online' ? 'active' : '' }}">
            <a href="{{ route('admin.penyakit.index') }}" class="nav-link"><i class="fas fa-medkit"></i>
                <span>Kecenderungan Perilaku</span></a>
        </li>
        <li class="{{ $title == 'Basis Pengetahuan' ? 'active' : '' }}">
            <a href="{{ route('admin.bp.index') }}" class="nav-link"><i class="fas fa-book"></i><span>Basis
                    Pengetahuan</span></a>
        </li>
        <li class="{{ $title == 'Hasil Identifikasi' ? 'active' : '' }}">
            <a href="{{ route('admin.diagnosa.index') }}" class="nav-link"><i class="fas fa-users"></i><span>Hasil
                    Identifikasi</span></a>
        </li>

        <li class="menu-header">Support</li>
        <li class="{{ $title == 'Akun' ? 'active' : '' }}">
            <a href="{{ route('admin.akun.index') }}" class="nav-link">
                <i class="fas fa-user"></i><span>Akun</span>
            </a>
        </li>
        <li class="{{ $title == 'Pesan' ? 'active' : '' }}">
            <a href="{{ route('admin.pesan.index') }}" class="nav-link">
                <i class="fas fa-envelope"></i><span>Pesan</span>
            </a>
        </li>
    </ul>
</aside>
