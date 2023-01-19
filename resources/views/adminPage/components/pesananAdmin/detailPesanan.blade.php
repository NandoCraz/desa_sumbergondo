@extends('adminPage.layouts.main')
@section('content')
    {{-- @if (session('berhasil'))
        <div class="alert alert-success mb-3 col-lg-10" role="alert">
            {{ session('berhasil') }}
        </div>
    @endif --}}
    <a href="javascript:history.back()" class="btn btn-danger mb-4"><i class="fa fa-chevron-left" aria-hidden="true"></i>
        Kembali</a>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Pesanan</h6>
        </div>
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
                    @if ($checkout->payment_status == '1' && $checkout->status != '5')
                        <h5 class="mt-4">Status : <span class="badge bg-warning text-light">Belum Dibayar</span></h5>
                    @endif
                    @if ($checkout->status == '1')
                        <h5 class="mt-4">Status : <span class="badge bg-dark text-light">Menunggu Konfirmasi</span></h5>
                    @endif
                    @if ($checkout->status == '2')
                        <h5 class="mt-4">Status : <span class="badge bg-secondary text-light">Sedang Diproses</span></h5>
                    @endif
                    @if ($checkout->status == '3')
                        <h5 class="mt-4">Status : <span class="badge bg-info text-light">Dikirim</span></h5>
                    @endif
                    @if ($checkout->status == '4')
                        <h5 class="mt-4">Status : <span class="badge bg-success text-light">Selesai</span></h5>
                    @endif
                    @if ($checkout->status == '5')
                        <h5 class="mt-4">Status : <span class="badge bg-danger text-light">Dibatalkan</span></h5>
                    @endif
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
@endsection
