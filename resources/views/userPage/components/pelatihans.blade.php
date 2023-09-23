{{-- @dd($bookings) --}}
@extends('userPage.layouts.main')
@section('container')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>#LikeSumberGondo</p>
                        <h1>Kelas Pelatihan Saya</h1>
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
                            <th scope="col">Total Harga</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($pelatihans->count() > 0)
                            @foreach ($pelatihans as $pelatihan)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $pelatihan->nama_pemesan }}</td>
                                    <td>Rp. {{ number_format($pelatihan->total) }}</td>
                                    <td>
                                        @if ($pelatihan->tipe_bayar == 'ditempat')
                                            @if ($pelatihan->status == 'Menunggu Konfirmasi')
                                                <span
                                                    class="badge fs-6 mt-2 bg-warning text-light p-1">{{ $pelatihan->status }}</span>
                                            @elseif($pelatihan->status == 'Dikonfirmasi')
                                                <span class="badge fs-6 mt-2 text-light p-1"
                                                    style="background-color: purple">Belum Dibayar</span>
                                            @elseif($pelatihan->status == 'Sudah Dibayar')
                                                <span
                                                    class="badge fs-6 mt-2 bg-success text-light p-1">{{ $pelatihan->status }}</span>
                                            @endif
                                        @endif
                                        @if ($pelatihan->tipe_bayar == 'website')
                                            @if ($pelatihan->payment_status == '1')
                                                <span class="badge fs-6 mt-2 text-light p-1"
                                                    style="background-color: purple">Belum Dibayar</span>
                                            @elseif($pelatihan->payment_status == '2')
                                                <span class="badge fs-6 mt-2 bg-success text-light p-1">Sudah Dibayar</span>
                                            @else
                                                <span class="badge fs-6 mt-2 bg-danger text-light p-1">Kadaluarsa</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="/pelatihan/{{ $pelatihan->uuid }}" class="btn btn-primary">Detail</a>
                                            @if (
                                                $pelatihan->status == 'Menunggu Konfirmasi' ||
                                                    $pelatihan->status == 'Dikonfirmasi' ||
                                                    $pelatihan->payment_status == '1')
                                                <form action="/hapusLayanan/{{ $pelatihan->id }}" method="post">
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
