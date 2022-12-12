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
                                @if ($checkout->payment_status == '1')
                                    <td>
                                        <h5><span class="badge bg-warning">Belum Dibayar</span></h5>
                                    </td>
                                @elseif($checkout->payment_status == '2')
                                    <td>
                                        <h5><span class="badge bg-success">Sudah Dibayar</span></h5>
                                    </td>
                                @else
                                    <td>
                                        <h5><span class="badge bg-danger">Dibatalkan</span></h5>
                                    </td>
                                @endif
                                <td>
                                    <a href="/pesanan/{{ $checkout->uuid }}" class="btn btn-primary">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
