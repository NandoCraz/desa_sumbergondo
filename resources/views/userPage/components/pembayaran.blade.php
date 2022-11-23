{{-- @dd($daftar_alamats) --}}
@extends('userPage.layouts.main')
@section('container')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Perbaiki & Modifikasi</p>
                        <h1>Pembayaran</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->
    <!-- products -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-title">
                                    <h3 class="text-center">Alamat Pengiriman</h3>
                                </div>
                                <div class="card-body">
                                    <h5>Nama Penerima : <p>{{ $daftar_alamats->nama_penerima }}</p>
                                    </h5>
                                    <h5>No. Handphone : <p>{{ $daftar_alamats->no_hp }}</p>
                                    </h5>
                                    <h5>Alamat : <p>{{ $daftar_alamats->alamat }},
                                            {{ $daftar_alamats->kode_pos }}, {{ $daftar_alamats->provinsi->nama_provinsi }},
                                            {{ $daftar_alamats->kota->nama_kab_kota }}.
                                        </p>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-details">
                                        <table class="cart-table">
                                            <thead class="cart-table-head">
                                                <tr class="table-head-row">
                                                    <th class="product-name">Nama Barang</th>
                                                    <th class="product-price">Harga</th>
                                                    <th class="product-quantity">Kuantitas</th>
                                                    <th class="product-total">Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($keranjangs as $keranjang)
                                                    <tr class="table-body-row">
                                                        <td class="product-name">
                                                            {{ $keranjang->barang->nama_barang }}
                                                        </td>
                                                        <td class="product-price">Rp.
                                                            {{ number_format($keranjang->barang->harga) }}
                                                        </td>
                                                        <td class="product-quantity text-center">
                                                            {{ $keranjang->kuantitas }}
                                                        </td>
                                                        <td class="product-total">Rp.
                                                            {{ number_format($keranjang->subtotal) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3" class="text-center">Total</td>
                                                    <td>Rp. {{ number_format($total) }}</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <a href="" class="btn btn-lg btn-warning text-light mt-4">Bayar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end products -->
@endsection
