{{-- @dd($checkouts) --}}
@extends('userPage.layouts.main')
@section('container')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Perbaiki & Modifikasi</p>
                        <h1>Pesanan Saya</h1>
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
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Penerima</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($checkouts as $checkout)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $checkout->daftarAlamat->nama_penerima }}</td>
                                <td>{{ $checkout->daftarAlamat->alamat }}</td>
                                <td>Rp. {{ number_format($checkout->total) }}</td>
                                @if ($checkout->payment_status == '1' && $checkout->status == '5')
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
                                <td class="d-flex justify-content-center">
                                    @if ($checkout->payment_status == '1' && $checkout->status != '5')
                                        <a href="/pesanan/{{ $checkout->uuid }}" class="btn btn-primary">Detail</a>
                                        <form action="/changeStatus/{{ $checkout->uuid }}" method="post" class="ms-2">
                                            @csrf
                                            <input type="hidden" name="action" value="batal">
                                            <button type="submit" class="btn btn-danger">Batalkan</button>
                                        </form>
                                    @elseif ($checkout->status == '3')
                                        <form action="/changeStatus/{{ $checkout->uuid }}" method="post" class="ms-2">
                                            <input type="hidden" name="action" value="terima">
                                            <button type="submit" class="btn btn-success">Diterima</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" class="fw-bold">Note<span class="text-danger">*</span></td>
                            <td colspan="4"><span class="text-dark">Harap Lakukan Pembayaran Sebelum 24 Jam, Karena
                                    Status Akan Berubah Menjadi Kadaluarsa Jika Melebihi Batas!</span></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
