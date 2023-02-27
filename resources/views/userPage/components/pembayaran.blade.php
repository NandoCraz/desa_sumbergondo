{{-- @dd(Request::all()) --}}
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
                        <div class="col-lg-12">
                            <div class="card p-3">
                                <div class="card-title">
                                    <h3 class="text-center">Alamat Pengiriman</h3>
                                </div>
                                <div class="card-body">
                                    <div>Hai, {{ $daftar_alamats->nama_penerima }}</div>
                                    <div>Terima kasih telah berbelanja Sparepart di NSParkel</div>
                                    <div class="mt-4">Tanggal Pemesanan :
                                        {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', now())->format('Y-m-d') }}
                                    </div>
                                    <div>Nama Penerima : {{ $daftar_alamats->nama_penerima }}</div>
                                    <div>No. Handphone : {{ $daftar_alamats->no_hp }}</div>
                                    <div>Tujuan Pengiriman : {{ $daftar_alamats->alamat }},
                                        {{ $daftar_alamats->kode_pos }}, {{ $daftar_alamats->provinsi->nama_provinsi }},
                                        {{ $daftar_alamats->kota->nama_kab_kota }}</div>
                                    <hr>
                                    <div>Jumlah Barang Dipesan : {{ $keranjangs->count() }}</div>
                                    <div>Jasa Pengiriman : {{ request()->courier }}</div>
                                    <div>Layanan Pengiriman : {{ request()->layanan }}</div>
                                    <div>Estimasi Sampai (Hari) : {{ request()->estimasi }}</div>
                                    <div>Catatan : {{ request()->catatan }}</div>
                                    <hr>
                                    <div>Status : -</div>
                                </div>
                                {{-- <h5>Nama Penerima : <p>{{ $daftar_alamats->nama_penerima }}</p>
                                    </h5>
                                    <h5>No. Handphone : <p>{{ $daftar_alamats->no_hp }}</p>
                                    </h5>
                                    <h5>Alamat : <p>{{ $daftar_alamats->alamat }},
                                            {{ $daftar_alamats->kode_pos }}, {{ $daftar_alamats->provinsi->nama_provinsi }},
                                            {{ $daftar_alamats->kota->nama_kab_kota }}.
                                        </p>
                                    </h5> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-4">
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
                                                <td colspan="3" class="text-center">Ongkos Kirim</td>
                                                <td>Rp. {{ number_format(request()->ongkir) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-center">Total</td>
                                                <td>Rp. {{ number_format($total + request()->ongkir) }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button class="btn btn-lg btn-warning text-light mt-4" id="bayar">Checkout</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mt-5 text-center">
                        <h3 class="pesan"></h3>
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
    <script>
        $('#bayar').on('click', function(e) {
            const pesan = $('.pesan');
            e.preventDefault();
            $.ajax({
                url: "{{ route('checkout.charger') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    daftar_alamat_id: "{{ request()->daftar_alamat_id }}",
                    courier: "{{ request()->courier }}",
                    layanan: "{{ request()->layanan }}",
                    catatan: "{{ request()->catatan }}",
                    ongkir: "{{ request()->ongkir }}",
                    estimasi: "{{ request()->estimasi }}"
                },
                success: function(response) {
                    snap.pay(response.snap_token, {
                        onSuccess: function(result) {
                            console.log(result);
                            window.location.href = '/pesanan'
                        }
                    })
                }
            })
        })
    </script>
@endsection
