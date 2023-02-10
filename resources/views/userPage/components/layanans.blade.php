{{-- @dd($bookings) --}}
@extends('userPage.layouts.main')
@section('container')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Perbaiki & Modifikasi</p>
                        <h1>Layanan Perbaikan Saya</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->
    <!-- products -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            {{-- @if (session('success'))
                <div class="alert alert-success mb-3 col-lg-12" role="alert">
                    {{ session('success') }}
                </div>
            @endif --}}
            <div class="table-responsive">
                <table class="table stripe" id="dataTable">
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
                                        @elseif($booking->status == 'Persetujuan Layanan')
                                            <span
                                                class="badge fs-6 mt-2 bg-primary text-light p-1">{{ $booking->status }}</span>
                                        @elseif($booking->status == 'Pembayaran')
                                            <span
                                                class="badge fs-6 mt-2 bg-warning text-light p-1">{{ $booking->status }}</span>
                                        @elseif($booking->status == 'Sedang Dikerjakan')
                                            <span class="badge fs-6 mt-2 text-light p-1"
                                                style="background-color: purple">{{ $booking->status }}</span>
                                        @elseif($booking->status == 'Selesai')
                                            <span
                                                class="badge fs-6 mt-2 bg-success text-light p-1">{{ $booking->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="/layanan/{{ $booking->uuid }}" class="btn btn-primary">Detail</a>
                                            @if ($booking->status == 'Konfirmasi Layanan')
                                                <form action="/hapusLayanan/{{ $booking->id }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger ms-2">Batalkan</button>
                                                </form>
                                            @endif
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
