@extends('userPage.layouts.main')
@section('container')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Perbaiki & Modifikasi</p>
                        <h1>Produk</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->
    <!-- products -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
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
                    </div>
                </div>
            </div>
            @if ($barangs->count())
                <div class="row product-lists mb-5">
                    @foreach ($barangs as $barang)
                        <div class="col-lg-4 col-md-6 text-center strawberry">
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
                                {{-- <a href="/keranjang/{{ $barang->id }}" class="cart-btn"><i
                                        class="fas fa-shopping-cart"></i>
                                    Add
                                    to Cart</a> --}}
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
