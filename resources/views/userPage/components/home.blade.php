{{-- @dd(auth()->user()) --}}
@extends('userPage.layouts.main')

@section('container')
    <!-- hero area -->
    <div class="hero-area hero-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 offset-lg-2 text-center">
                    <div class="hero-text">
                        <div class="hero-text-tablecell">
                            <p class="subtitle">Perbaiki & Modifikasi</p>
                            <h1>Spare Part dan Pelayanan Bengkel Online</h1>
                            <div class="hero-btns">
                                <a href="/produk" class="bordered-btn">Lihat Produk</a>
                                <a href="/kontak" class="bordered-btn">Kontak Kami</a>
                                <a href="#" class="bordered-btn" data-bs-toggle="modal"
                                    data-bs-target="#komentar">Beri Komentar</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end hero area -->
    @include('userPage.partials.modal.komentar')
    <!-- features list section -->
    <div class="list-section pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="list-box d-flex align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <div class="content">
                            <h3>Ongkos Kirim Murah</h3>
                            <p>Saat Berbelanja dan Menggunakan Pelayanan Kami!</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="list-box d-flex align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-phone-volume"></i>
                        </div>
                        <div class="content">
                            <h3>24/7 Layanan</h3>
                            <p>Siap Melayani Setiap Hari!</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="list-box d-flex justify-content-start align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-sync"></i>
                        </div>
                        <div class="content">
                            <h3>Barang Berkualitas</h3>
                            <p>Barang Di Toko Kami Berkualitas Impor!</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- end features list section -->

    <!-- product section -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3>Produk <span class="orange-text">Kami</span></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet
                            beatae optio.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($barangs as $barang)
                    <div class="col-lg-4 col-md-6 text-center">
                        <div class="single-product-item">
                            <div class="product-image">
                                <a href="/single-produk/{{ $barang->uuid }}"><img
                                        src="{{ asset('storage/' . $barang->picture_barang) }}"
                                        alt="{{ $barang->nama }}"></a>
                            </div>
                            <h3>{{ $barang->nama_barang }}</h3>
                            <p class="product-price"><span>Stok : {{ $barang->stok }}</span> Rp.
                                {{ number_format($barang->harga) }} </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- end product section -->

    <!-- testimonail-section -->
    <div class="testimonail-section mt-150 mb-150">
        <div class="container">
            @include('userPage.partials.modal.balasan')
            <div class="row">
                <div class="col-lg-10 offset-lg-1 text-center">
                    <div class="splide">
                        <div class="splide__track list-komentar">
                            <ul class="splide__list">
                                @foreach ($komentars as $kmntr)
                                    <li class="splide__slide">
                                        <button class="btn viewdetails" data-id='{{ $kmntr->id }}'>
                                            <div class="single-testimonial-slider">
                                                <div class="client-avater">
                                                    @if ($kmntr->user->picture_profile != null)
                                                        <img src="{{ asset('storage/' . $kmntr->user->picture_profile) }}">
                                                    @else
                                                        <img src="{{ asset('storage/profilePicture/userDef.png') }}">
                                                    @endif
                                                </div>
                                                <div class="client-meta">
                                                    <h3>{{ $kmntr->user->name }} <span>{{ $kmntr->user->username }}</span>
                                                    </h3>
                                                    <p class="testimonial-body">
                                                        " {{ $kmntr->komentar }} "
                                                    </p>
                                                    <div class="last-icon">
                                                        <i class="fas fa-quote-right"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end testimonail-section -->

    <!-- logo carousel -->
    {{-- <div class="logo-carousel-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="logo-carousel-inner">
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/1.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/2.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/3.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/4.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="assets/img/company-logos/5.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- end logo carousel -->
@endsection
@section('script')
    @if (session('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal
                        .stopTimer)
                    toast.addEventListener('mouseleave', Swal
                        .resumeTimer)
                }
            })
            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            }).then((result) => {
                location.reload();
            })
        </script>
    @endif
    <script>
        $(document).ready(function() {
            new Splide('.splide').mount();

            $('.list-komentar').on('click', '.viewdetails', function() {
                var komentarid = $(this).attr('data-id');
                console.log(komentarid);
                console.log('test');

                if (komentarid > 0) {

                    // AJAX request
                    var url = "{{ route('balasanKomentar', [':komentarid']) }}";
                    url = url.replace(':komentarid', komentarid);

                    // Empty modal data
                    $('#detailKomentar').empty();

                    $.ajax({
                        url: url,
                        dataType: 'json',
                        success: function(response) {

                            // Add employee details
                            $('#detailKomentar').html(response.html);

                            // Display Modal
                            $('#komentarModal').modal('show');
                        }
                    });
                }
            });
        });
    </script>
@endsection
