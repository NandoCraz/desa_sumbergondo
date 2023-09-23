<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard-admin">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('assets/img/Logo_Rejeki_Barokah.png') }}" alt="NSParkel" width="185" class="">
        </div>
        {{-- <div class="sidebar-brand-text mx-3">NS<sub>parkel</sub></div> --}}
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('dashboard-admin') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard-admin">
            <i class="fas fa-fw fa-th-large"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <div class="sidebar-heading mt-3">
        Admin
    </div>

    <li class="nav-item {{ Request::Is('master*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-database"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/master/data-kategori">Data Kategori</a>
                <a class="collapse-item" href="/master/data-barang">Data Barang</a>
                <a class="collapse-item" href="/master/data-rw">Data RW</a>
                <a class="collapse-item" href="/master/data-pamflet">Pamflet</a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ Request::Is('pesanan*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pesananUtilities"
            aria-expanded="true" aria-controls="pesananUtilities">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            <span>Pesanan</span>
        </a>
        <div id="pesananUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/pesanan/belum-dibayar">Belum Dibayar</a>
                <a class="collapse-item" href="/pesanan/menunggu-konfirmasi">Menunggu Konfirmasi</a>
                <a class="collapse-item" href="/pesanan/diproses">Sedang Diproses</a>
                <a class="collapse-item" href="/pesanan/dikirim">Dikirim</a>
                <a class="collapse-item" href="/pesanan/selesai">Selesai</a>
                <a class="collapse-item" href="/pesanan/dibatalkan">Dibatalkan</a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ Request::Is('layanan-admin') ? 'active' : '' }}">
        <a class="nav-link" href="/layanan-admin">
            <i class="fa fa-calendar" aria-hidden="true"></i>
            <span>Layanan Booking</span>
        </a>
    </li>
    <li class="nav-item {{ Request::Is('pelatihan-admin') ? 'active' : '' }}">
        <a class="nav-link" href="/pelatihan-admin">
            <i class="fa fa-chalkboard" aria-hidden="true"></i>
            <span>Kelas Pelatihan</span>
        </a>
    </li>
    <li class="nav-item {{ Request::Is('jadwal-pengangkutan') ? 'active' : '' }}">
        <a class="nav-link" href="/jadwal-pengangkutan">
            <i class="fa fa-clock" aria-hidden="true"></i>
            <span>Jadwal Pengangkutan</span>
        </a>
    </li>
    <li class="nav-item {{ Request::Is('bank-sampah*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#bankUtilities"
            aria-expanded="true" aria-controls="bankUtilities">
            <i class="fa fa-trash" aria-hidden="true"></i>
            <span>Bank Sampah</span>
        </a>
        <div id="bankUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/bank-sampah/data-bank">Data Bank</a>
                <a class="collapse-item" href="/bank-sampah/komposter">Tagihan Komposter</a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ Request::Is('data-pengolahan') ? 'active' : '' }}">
        <a class="nav-link" href="/data-pengolahan">
            <i class="fa fa-recycle" aria-hidden="true"></i>
            <span>Iuran Sampah</span>
        </a>
    </li>
    <li class="nav-item {{ Request::Is('seluruh-user') ? 'active' : '' }}">
        <a class="nav-link" href="/seluruh-user">
            <i class="fas fa-solid fa-users"></i>
            <span>Seluruh Warga</span>
        </a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
