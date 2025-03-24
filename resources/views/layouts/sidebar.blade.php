<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="#" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bold ms-2">SPK Topsis</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

    @if (Auth::user()->is_admin === 3)
        <!-- Dashboards -->
        <li class="menu-item {{ request()->is('user*') ? 'active' : '' }}">
            <a href="/user" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboards">Dashboards</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Pegawai</span></li>

        <li class="menu-item {{ request()->is('pegawai*') ? 'active' : '' }}">
            <a href="/pegawai" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Data Pegawai">Data Pegawai</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Pengguna</span></li>

        <li class="menu-item {{ request()->is('pengguna*') ? 'active' : '' }}">
            <a href="/pengguna" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-pin"></i>
                <div data-i18n="Data User">Data User</div>
            </a>
        </li>

    @elseif (Auth::user()->is_admin === 2)

        <!-- Dashboards -->
        <li class="menu-item {{ request()->is('staf*') ? 'active' : '' }}">
            <a href="/staf" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboards">Dashboards</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Master Data</span></li>

        <li class="menu-item {{ request()->is('jabatan*') ? 'active' : '' }}">
            <a href="/jabatan" class="menu-link">
                <i class="menu-icon tf-icons bx bx-book-content"></i>
                <div data-i18n="Data Jabatan">Data Jabatan</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('pangkat*') ? 'active' : '' }}">
            <a href="/pangkat" class="menu-link">
                <i class="menu-icon tf-icons bx bx-spreadsheet"></i>
                <div data-i18n="Data Pangkat">Data Pangkat</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('bobot*') ? 'active' : '' }}">
            <a href="/bobot" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Data Bobot">Data Bobot</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('kriteria*') ? 'active' : '' }}">
            <a href="/kriteria" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Data Kriteria">Data Kriteria</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Klasifikasi</span></li>

        <li class="menu-item {{ request()->is('himpunan*') ? 'active' : '' }}">
            <a href="/himpunan" class="menu-link">
                <i class="menu-icon tf-icons bx bx-columns"></i>
                <div data-i18n="Himpunan Kriteria">Himpunan Kriteria</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('klasifikasi*') ? 'active' : '' }}">
            <a href="/klasifikasi" class="menu-link">
                <i class="menu-icon tf-icons bx bx-sitemap"></i>
                <div data-i18n="Proses Klasifikasi">Proses Klasifikasi</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('topsis*') ? 'active' : '' }}">
            <a href="/topsis" class="menu-link">
                <i class="menu-icon tf-icons bx bx-objects-vertical-bottom"></i>
                <div data-i18n="Analisa">Analisa</div>
            </a>
        </li>
    
    @elseif (Auth::user()->is_admin === 1)

        <!-- Dashboards -->
        <li class="menu-item {{ request()->is('manager*') ? 'active' : '' }}">
            <a href="/manager" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboards">Dashboards</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Laporan</span></li>

        <li class="menu-item {{ request()->is('laporan*') ? 'active' : '' }}">
            <a href="/laporan" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Laporan Kinerja">Laporan Kinerja</div>
            </a>
        </li>
    @endif
    </ul>
</aside>
<!-- / Menu -->