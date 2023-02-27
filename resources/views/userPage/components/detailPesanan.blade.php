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
                        <div class="col-lg-12">
                            <div class="card p-4">
                                <div class="card-title">
                                    <h3 class="text-center">NSParkel</h3>
                                </div>
                                <div class="card-body">
                                    <div>Hai, {{ $checkout->daftarAlamat->nama_penerima }}</div>
                                    <div>Terima kasih telah berbelanja Sparepart di NSParkel</div>
                                    <div class="mt-4">Tanggal Pemesanan :
                                        {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $checkout->created_at)->format('Y-m-d') }}
                                    </div>
                                    <div>Nama Penerima : {{ $checkout->daftarAlamat->nama_penerima }}</div>
                                    <div>No. Handphone : {{ $checkout->daftarAlamat->no_hp }}</div>
                                    <div>Tujuan Pengiriman : {{ $checkout->daftarAlamat->alamat }},
                                        {{ $checkout->daftarAlamat->kode_pos }},
                                        {{ $checkout->daftarAlamat->provinsi->nama_provinsi }},
                                        {{ $checkout->daftarAlamat->kota->nama_kab_kota }}</div>
                                    <hr>
                                    <div>Jumlah Barang Dipesan : {{ $checkout->pesanans->count() }}</div>
                                    <div>Jasa Pengiriman : {{ $checkout->courier }}</div>
                                    <div>Layanan Pengiriman : {{ $checkout->layanan }}</div>
                                    <div>Estimasi Sampai (Hari) : {{ $checkout->estimasi }}</div>
                                    <div>Catatan : {{ $checkout->catatan }}</div>
                                    <hr>
                                    <div>Status : @if ($checkout->payment_status == '1' && $checkout->status == '5')
                                            <td>
                                                <h5><span class="badge bg-danger">Dibatalkan</span></h5>
                                            </td>
                                        @elseif ($checkout->payment_status == '1')
                                            <td>
                                                <h5><span class="badge bg-warning">Belum Dibayar</span></h5>
                                            </td>
                                        @elseif($checkout->payment_status == '2')
                                            @if ($checkout->status == '1')
                                                <td>
                                                    <h5><span class="badge bg-dark">Menunggu Konfirmasi</span></h5>
                                                </td>
                                            @elseif($checkout->status == '2')
                                                <td>
                                                    <h5><span class="badge bg-secondary">Diproses</span></h5>
                                                </td>
                                            @elseif($checkout->status == '3')
                                                <td>
                                                    <h5><span class="badge bg-info text-light">Dikirim</span></h5>
                                                </td>
                                            @elseif($checkout->status == '4')
                                                <td>
                                                    <h5><span class="badge bg-success">Selesai</span></h5>
                                                </td>
                                            @endif
                                        @else
                                            <td>
                                                <h5><span class="badge bg-danger">Kadaluarsa</span></h5>
                                            </td>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-details">
                                        <table class="cart-table text-center">
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
