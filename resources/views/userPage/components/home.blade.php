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
                            <h1 style="color: rgb(255, 255, 255)">DESA SUMBERGONDO</h1>
                            <h2 style="color: rgb(255, 255, 255)">PENGELOLAAN SAMPAH MANDIRI</h2>
                            {{-- <p class="subtitle">Bank Sampah, Komposter, dan Incenerator</p> --}}
                            <div class="hero-btns">
                                <a href="" class="bordered-btn"
                                    style="cursor: not-allowed; pointer-events: none;">Desa Sumbergondo telah melakukan
                                    pengelolaan sampah mandiri sejak 2018 dan menjadi satu-satunya desa yang tidak membuang
                                    sampah ke TPA sejak 2019. Pengolahan sampah di Desa Sumbergondo melibatkan insenerator,
                                    komposter, dan bank sampah. Sehingga meningkatkan pendapatan desa.</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end hero area -->
    {{-- @include('userPage.partials.modal.komentar') --}}
    <!-- features list section -->
    <div class="list-section pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="list-box d-flex align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-solid fa-dumpster"></i>
                        </div>
                        <div class="content">
                            <h3>Bank Sampah</h3>
                            <p>Pengelolaan sampah rumah tangga yang bisa didaur ulang dan dimanfaatkan</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="list-box d-flex align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-solid fa-recycle"></i>
                        </div>
                        <div class="content">
                            <h3>Komposter</h3>
                            <p>Pengelolaan sampah organik menjadi pupuk cair dan pupuk kering</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="list-box d-flex justify-content-start align-items-center">
                        <div class="list-icon">
                            <i class="fas fa-solid fa-dumpster-fire"></i>
                        </div>
                        <div class="content">
                            <h3>Incenerator</h3>
                            <p>Pengelolaan sampah melalui proses pembakaran yang memiliki filter udara yang ramah lingkungan
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- end features list section -->

    <!-- product section -->
    <div class="product-section mb-4" style="margin-top: 75px">
        <div class="container">
            <div class="row">
                <div class="col-6 text-center">
                    <div class="section-title">
                        <h3>Pilah <span class="orange-text">Sampah</span></h3>
                        <img src="{{ asset('assets/img/Plan evaluation.png') }}" alt="">
                    </div>
                </div>
                <div class="col-6 text-center">
                    <div class="section-title">
                        <h3>Video <span class="orange-text">Edukasi</span></h3>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe width="420" height="315" src="https://www.youtube.com/embed/dy0FNMOmrAk"></iframe>
                        </div>
                        <p class="fw-bold mt-3">Berikut ini adalah video edukasi pengolahan sampah </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
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


        });
    </script>
@endsection
