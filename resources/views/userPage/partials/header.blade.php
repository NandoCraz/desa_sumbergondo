<div class="top-header-area" id="sticker">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 text-center">
                <div class="main-menu-wrap">
                    <!-- logo -->
                    <div class="site-logo">
                        <a href="/">
                            <img src="{{ asset('assets/img/logo_ukk.png') }}" width="60" alt="">
                        </a>
                    </div>
                    <!-- logo -->

                    <!-- menu start -->
                    <nav class="main-menu">
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li><a href="/produk">Produk</a></li>
                            <li><a href="/booking">Booking</a></li>
                            <li><a href="/kontak">Kontak</a></li>
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
                                    <a class="shopping-cart" href="/keranjang"><i class="fas fa-shopping-cart"></i></a>
                                    <a class="mobile-hide search-bar-icon" href="#"><i
                                            class="fas fa-search"></i></a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                    <div class="mobile-menu"></div>
                    <!-- menu end -->
                </div>
            </div>
        </div>
    </div>
</div>
