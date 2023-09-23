@extends('adminPage.layouts.main')
@section('content')
    {{-- @if (session('berhasil'))
        <div class="alert alert-success mb-3 col-lg-10" role="alert">
            {{ session('berhasil') }}
        </div>
    @endif --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Menunggu Konfirmasi Admin</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-center dataTable">
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
                        @if ($menungguKonfirmasi->count() > 0)
                            @foreach ($menungguKonfirmasi as $konfAdm)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $konfAdm->nama_pemesan }}</td>
                                    <td>Rp. {{ number_format($konfAdm->total) }}</td>
                                    <td>
                                        <span
                                            class="badge fs-6 mt-2 bg-warning text-light p-1">{{ $konfAdm->status }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="/layanan-admin/{{ $konfAdm->id }}" class="btn btn-primary">Detail</a>
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
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Belum Dibayar</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-center dataTable">
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
                        @if ($dikonfirmasi->count() > 0 || $belumDibayar->count() > 0)
                            @foreach ($dikonfirmasi as $konf)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $konf->nama_pemesan }}</td>
                                    <td>Rp. {{ number_format($konf->total) }}
                                    </td>
                                    <td>
                                        <span class="badge fs-6 mt-2 text-light p-1" style="background-color: purple">Belum
                                            Dibayar</span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="/layanan-admin/{{ $konf->id }}" class="btn btn-primary">Detail</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @foreach ($belumDibayar as $blmByr)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $blmByr->nama_pemesan }}</td>
                                    <td>Rp. {{ number_format($blmByr->total) }}
                                    </td>
                                    <td>
                                        <span class="badge fs-6 mt-2 text-light p-1" style="background-color: purple">Belum
                                            Dibayar</span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="/layanan-admin/{{ $blmByr->id }}" class="btn btn-primary">Detail</a>
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
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sudah Dibayar</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table text-center dataTable">
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
                        @if ($sudahDibayar->count() > 0)
                            @foreach ($sudahDibayar as $pmbyr)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $pmbyr->nama_pemesan }}</td>
                                    <td>Rp. {{ number_format($pmbyr->total) }}</td>
                                    <td>
                                        <span class="badge fs-6 mt-2 bg-success text-light p-1">{{ $pmbyr->status }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="/layanan-admin/{{ $pmbyr->id }}" class="btn btn-primary">Detail</a>
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
    <script>
        $(document).ready(function() {
            $(".selector").flatpickr({
                dateFormat: "Y-m-d",
                mode: "range",
            });
        });
    </script>
@endsection
