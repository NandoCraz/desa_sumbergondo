<div class="top-header-area" id="sticker">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 text-center">
                <div class="main-menu-wrap">
                    <!-- logo -->
                    <div class="site-logo">
                        <a href="/">
                            <img src="{{ asset('assets/img/Logo_Rejeki_Barokah.png') }}">
                        </a>
                    </div>
                    <!-- logo -->

                    <!-- menu start -->
                    <nav class="main-menu">
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li><a href="/produk">Pupuk Organik</a></li>
                            <li><a href="/booking">Wisata Edukasi</a></li>
                            <li><a href="/kelas-pelatihan">Pelatihan</a></li>
                            @guest
                                <li><a href="/login">Login</a></li>
                            @endguest
                            @auth
                                <li><a href="#">Profil</a>
                                    <ul class="sub-menu">
                                        <li><a href="/profile-saya">Profil Saya</a></li>
                                        <li><a href="/pengaturan">Pengaturan</a></li>
                                        <li><a href="/pesanan">Pesanan Saya</a></li>
                                        <li><a href="/layanans">Layanan Saya</a></li>
                                        <li><a href="/pelatihans">Kelas Saya</a></li>
                                        <li>
                                            <form action="/logout" method="post">
                                                @csrf
                                                <button type="submit" class="btn text-dark fw-bold">
                                                    Logout
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @endauth
                            <li>
                                <div class="header-icons">
                                    <a class="shopping-cart" href="/keranjang"><i class="fas fa-shopping-cart"></i>
                                        @if (isset(auth()->user()->id))
                                            <span class="top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                {{ App\Models\Keranjang::where('user_id', auth()->user()->id)->count() }}
                                            </span>
                                        @endif
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <div class="mobile-menu"></div>
                    <!-- menu end -->
                </div>
            </div>
        </div>
    </div>
</div>
