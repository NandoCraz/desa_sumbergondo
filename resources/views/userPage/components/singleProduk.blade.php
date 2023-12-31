@extends('userPage.layouts.main')
@section('container')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Lihat Untuk Detail</p>
                        <h1>Detail Produk</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    {{-- <div class="container my-4">
        @if (session('success'))
            <div class="alert alert-success mb-3 col-lg-10" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger mb-3 col-lg-10" role="alert">
                {{ session('error') }}
            </div>
        @endif
    </div> --}}


    <!-- single product -->
    <div class="single-product mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="single-product-img">
                        <img src="{{ asset('storage/' . $barang->picture_barang) }}" alt="{{ $barang->nama_barang }}">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="single-product-content">
                        <h3>{{ $barang->nama_barang }}</h3>
                        <p class="single-product-pricing"><span>Stok : {{ $barang->stok }}</span> Rp.
                            {{ number_format($barang->harga) }}</p>
                        <p>{{ $barang->deskripsi }}</p>
                        <div class="single-product-form">
                            <form action="/keranjang/{{ $barang->id }}" method="POST">
                                @csrf
                                <input type="hidden" name="type" value="single">
                                <input type="number" placeholder="0" min="0" max="{{ $barang->stok }}"
                                    name="kuantitas"><br>
                                {{-- <a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a> --}}
                                <button type="submit" class="btn btn-warning text-light">Add to Cart</button>
                            </form>
                            <p class="mt-5"><strong>Kategori : </strong>
                                @foreach ($barang->kategori as $kategori)
                                    <ul class="list-group">
                                        <li class="list-group-item">{{ $kategori->nama_kategori }}</li>
                                    </ul>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end single product -->
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
@endsection
