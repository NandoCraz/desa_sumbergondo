{{-- @dd($checkout) --}}
@extends('userPage.layouts.main')
@section('container')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Perbaiki & Modifikasi</p>
                        <h1>Detail Pesanan</h1>
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
                                    <h5>Nama Penerima : <p>{{ $checkout->daftarAlamat->nama_penerima }}</p>
                                    </h5>
                                    <h5>No. Handphone : <p>{{ $checkout->daftarAlamat->no_hp }}</p>
                                    </h5>
                                    <h5>Alamat : <p>{{ $checkout->daftarAlamat->alamat }},
                                            {{ $checkout->daftarAlamat->kode_pos }},
                                            {{ $checkout->daftarAlamat->provinsi->nama_provinsi }},
                                            {{ $checkout->daftarAlamat->kota->nama_kab_kota }}.
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
                                                @foreach ($checkout->pesanans as $pesanan)
                                                    <tr class="table-body-row">
                                                        <td class="product-name">
                                                            {{ $pesanan->barang->nama_barang }}
                                                        </td>
                                                        <td class="product-price">Rp.
                                                            {{ number_format($pesanan->barang->harga) }}
                                                        </td>
                                                        <td class="product-quantity text-center">
                                                            {{ $pesanan->kuantitas }}
                                                        </td>
                                                        <td class="product-total">Rp.
                                                            {{ number_format($pesanan->sub_total) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3" class="text-center">Ongkos Kirim</td>
                                                    <td>Rp. {{ number_format($checkout->ongkir) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="text-center">Total</td>
                                                    <td>Rp. {{ number_format($checkout->total) }}</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @if ($checkout->payment_status == '1')
                                <button class="btn btn-lg btn-warning text-light mt-4" id="bayar">Bayar</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end products -->
@endsection

@section('script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    @if ($checkout->payment_status == '1')
        <script>
            $('#bayar').on('click', function(e) {
                e.preventDefault();
                snap.pay('{{ $checkout->snap_token }}', {
                    onSuccess: function(result) {
                        console.log(result);
                        window.location.href = '/pesanan'
                    }
                });
            })
        </script>
    @endif
@endsection
