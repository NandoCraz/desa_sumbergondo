@extends('adminPage.layouts.main')
@section('content')
    @if (session('berhasil'))
        <div class="alert alert-success mb-3 col-lg-10" role="alert">
            {{ session('berhasil') }}
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pesanan Belum Dibayar</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Pemesan</th>
                            <th scope="col">Tempat Perbaikan</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($bookings->count() > 0)
                            @foreach ($bookings as $booking)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $booking->nama_pemesan }}</td>
                                    <td>{{ $booking->tempat_perbaikan == 'dirumah' ? 'Di Rumah' : 'Di Bengkel' }}</td>
                                    <td>{{ $booking->alamat == null ? '-' : $booking->alamat }}</td>
                                    <td>Rp. {{ number_format($booking->total + $booking->total_harga_barang) }}</td>
                                    <td>
                                        @if ($booking->status == 'Konfirmasi Layanan')
                                            <span class="badge bg-secondary p-1">{{ $booking->status }}</span>
                                        @elseif($booking->status == 'Menunggu Konfirmasi Admin')
                                            <span
                                                class="badge fs-6 mt-2 bg-info text-light p-1">{{ $booking->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="/layanan-admin/{{ $booking->id }}" class="btn btn-primary">Detail</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center">Tidak Ada Layanan Dipesan...</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
