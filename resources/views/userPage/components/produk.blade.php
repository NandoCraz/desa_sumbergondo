@extends('userPage.layouts.main')
@section('container')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <h1>Pupuk Hasil Komposter</h1>
                        <p>#LikeSumberGondo</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->
    <!-- products -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            {{-- @if (session('success'))
                <div class="alert alert-success mb-3 col-lg-10" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger mb-3 col-lg-10" role="alert">
                    {{ session('error') }}
                </div>
            @endif --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="product-filters">
                        <ul>
                            <li class="{{ Request::Is('produk') ? 'active' : '' }}"><a href="/produk"
                                    class="text-dark">All</a></li>
                            @foreach ($kategoris as $kategori)
                                <li class="{{ Request::Is('produk/kategori/' . $kategori->id) ? 'active' : '' }}"><a
                                        href="/produk/kategori/{{ $kategori->id }}"
                                        class="text-dark">{{ $kategori->nama_kategori }}</a></li>
                            @endforeach
                        </ul>
                        <div class="row justify-content-center mt-5">
                            <input type="text" id="cari" class="form-control col-lg-8 p-3" placeholder="Cari Barang"
                                autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
            @if ($barangs->count())
                <div class="row mb-5" id="loopProduct">
                    @foreach ($barangs as $barang)
                        <div class="col-lg-4 col-md-6 text-center">
                            <div class="single-product-item">
                                <div class="product-image">
                                    <a href="/single-produk/{{ $barang->uuid }}"><img
                                            src="{{ asset('storage/' . $barang->picture_barang) }}"
                                            alt="{{ $barang->nama_barang }}"></a>
                                </div>
                                <h3>{{ $barang->nama_barang }}</h3>
                                <p class="product-price"><span>Stok : {{ $barang->stok }}</span> Rp.
                                    {{ number_format($barang->harga) }}
                                </p>
                                <form action="/keranjang/{{ $barang->id }}" method="post">
                                    @csrf
                                    <input type="hidden" name="type" value="many">
                                    <button type="submit" class="btn btn-lg btn-warning text-light"><i
                                            class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <h1 class="text-center mb-5">Barang Tidak Tersedia...</h1>
            @endif
        </div>
    </div>
    <!-- end products -->
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
    @if (session('error'))
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
                icon: 'error',
                title: '{{ session('error') }}'
            }).then((result) => {
                location.reload();
            })
        </script>
    @endif
    <script>
        function debounce(func, timeout = 800) {
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    func.apply(this, args);
                }, timeout);
            };
        }
        const cari = document.querySelector('#cari');
        const products = document.querySelector('#loopProduct');
        // const halos = ['tes',
        //     'halo', 'tod'
        // ];
        cari.addEventListener('keyup', debounce(function() {
            const cariBr = cari.value;
            const url = `/cari`;
            $.ajax({
                url: url,
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': '{{ @csrf_token() }}'
                },
                data: {
                    cari: cariBr,
                },
                success: function(response) {
                    // console.log(response);
                    products.innerHTML = response.map(barang =>
                        `<div class="col-lg-4 col-md-6 text-center">
                            <div class="single-product-item">
                                <div class="product-image">
                                    <a href="/single-produk/${barang.uuid}"><img
                                            src="/storage/${barang.picture_barang}"
                                            alt="${barang.nama_barang}"></a>
                                </div>
                                <h3>${barang.nama_barang }</h3>
                                <p class="product-price"><span>Stok : ${barang.stok}</span> Rp.
                                    ${Intl.NumberFormat().format(barang.harga)}
                                </p>
                                <form action="/keranjang/${barang.id}" method="post">
                                    @csrf
                                    <input type="hidden" name="type" value="many">
                                    <button type="submit" class="btn btn-lg btn-warning text-light"><i
                                            class="fa fa-shopping-cart" aria-hidden="true"></i> Add to Cart</button>
                                </form>
                            </div>
                        </div>`
                    ).join('');
                }
            });
        }, 800));
    </script>
@endsection
