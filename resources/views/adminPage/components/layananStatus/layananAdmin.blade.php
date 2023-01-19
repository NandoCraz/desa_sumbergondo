@extends('adminPage.layouts.main')
@section('content')
    {{-- @if (session('berhasil'))
        <div class="alert alert-success mb-3 col-lg-10" role="alert">
            {{ session('berhasil') }}
        </div>
    @endif --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Menunggu Konfirmasi Customer</h6>
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
                        @if ($menungguKonfirmasi->count() > 0)
                            @foreach ($menungguKonfirmasi as $mngKonf)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $mngKonf->nama_pemesan }}</td>
                                    <td>{{ $mngKonf->tempat_perbaikan == 'dirumah' ? 'Di Rumah' : 'Di Bengkel' }}</td>
                                    <td>{{ $mngKonf->alamat == null ? '-' : $mngKonf->alamat }}</td>
                                    <td>Rp. {{ number_format($mngKonf->total + $mngKonf->total_harga_barang) }}</td>
                                    <td>
                                        @if ($mngKonf->status == 'Konfirmasi Layanan')
                                            <span class="badge bg-secondary text-light p-1">{{ $mngKonf->status }}</span>
                                        @elseif($mngKonf->status == 'Menunggu Konfirmasi Admin')
                                            <span
                                                class="badge fs-6 mt-2 bg-info text-light p-1">{{ $mngKonf->status }}</span>
                                        @elseif($mngKonf->status == 'Persetujuan Layanan')
                                            <span
                                                class="badge fs-6 mt-2 bg-primary text-light p-1">{{ $mngKonf->status }}</span>
                                        @elseif($mngKonf->status == 'Pembayaran')
                                            <span
                                                class="badge fs-6 mt-2 bg-warning text-light p-1">{{ $mngKonf->status }}</span>
                                        @elseif($mngKonf->status == 'Sedang Dikerjakan')
                                            <span class="badge fs-6 mt-2 text-light p-1"
                                                style="background-color: purple">{{ $mngKonf->status }}</span>
                                        @elseif($mngKonf->status == 'Selesai')
                                            <span
                                                class="badge fs-6 mt-2 bg-success text-light p-1">{{ $mngKonf->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="/layanan-admin/{{ $mngKonf->id }}" class="btn btn-primary">Detail</a>
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
            <h6 class="m-0 font-weight-bold text-primary">Menunggu Konfirmasi Admin</h6>
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
                        @if ($konfirmasiAdmin->count() > 0)
                            @foreach ($konfirmasiAdmin as $konfAdm)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $konfAdm->nama_pemesan }}</td>
                                    <td>{{ $konfAdm->tempat_perbaikan == 'dirumah' ? 'Di Rumah' : 'Di Bengkel' }}</td>
                                    <td>{{ $konfAdm->alamat == null ? '-' : $konfAdm->alamat }}</td>
                                    <td>Rp. {{ number_format($konfAdm->total + $konfAdm->total_harga_barang) }}</td>
                                    <td>
                                        @if ($konfAdm->status == 'Konfirmasi Layanan')
                                            <span class="badge bg-secondary text-light p-1">{{ $konfAdm->status }}</span>
                                        @elseif($konfAdm->status == 'Menunggu Konfirmasi Admin')
                                            <span
                                                class="badge fs-6 mt-2 bg-info text-light p-1">{{ $konfAdm->status }}</span>
                                        @elseif($konfAdm->status == 'Persetujuan Layanan')
                                            <span
                                                class="badge fs-6 mt-2 bg-primary text-light p-1">{{ $konfAdm->status }}</span>
                                        @elseif($konfAdm->status == 'Pembayaran')
                                            <span
                                                class="badge fs-6 mt-2 bg-warning text-light p-1">{{ $konfAdm->status }}</span>
                                        @elseif($konfAdm->status == 'Sedang Dikerjakan')
                                            <span class="badge fs-6 mt-2 text-light p-1"
                                                style="background-color: purple">{{ $konfAdm->status }}</span>
                                        @elseif($konfAdm->status == 'Selesai')
                                            <span
                                                class="badge fs-6 mt-2 bg-success text-light p-1">{{ $konfAdm->status }}</span>
                                        @endif
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
            <h6 class="m-0 font-weight-bold text-primary">Persetujuan Layanan</h6>
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
                        @if ($persetujuanLayanan->count() > 0)
                            @foreach ($persetujuanLayanan as $prstLayanan)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $prstLayanan->nama_pemesan }}</td>
                                    <td>{{ $prstLayanan->tempat_perbaikan == 'dirumah' ? 'Di Rumah' : 'Di Bengkel' }}</td>
                                    <td>{{ $prstLayanan->alamat == null ? '-' : $prstLayanan->alamat }}</td>
                                    <td>Rp. {{ number_format($prstLayanan->total + $prstLayanan->total_harga_barang) }}
                                    </td>
                                    <td>
                                        @if ($prstLayanan->status == 'Konfirmasi Layanan')
                                            <span
                                                class="badge bg-secondary text-light p-1">{{ $prstLayanan->status }}</span>
                                        @elseif($prstLayanan->status == 'Menunggu Konfirmasi Admin')
                                            <span
                                                class="badge fs-6 mt-2 bg-info text-light p-1">{{ $prstLayanan->status }}</span>
                                        @elseif($prstLayanan->status == 'Persetujuan Layanan')
                                            <span
                                                class="badge fs-6 mt-2 bg-primary text-light p-1">{{ $prstLayanan->status }}</span>
                                        @elseif($prstLayanan->status == 'Pembayaran')
                                            <span
                                                class="badge fs-6 mt-2 bg-warning text-light p-1">{{ $prstLayanan->status }}</span>
                                        @elseif($prstLayanan->status == 'Sedang Dikerjakan')
                                            <span class="badge fs-6 mt-2 text-light p-1"
                                                style="background-color: purple">{{ $prstLayanan->status }}</span>
                                        @elseif($prstLayanan->status == 'Selesai')
                                            <span
                                                class="badge fs-6 mt-2 bg-success text-light p-1">{{ $prstLayanan->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="/layanan-admin/{{ $prstLayanan->id }}"
                                                class="btn btn-primary">Detail</a>
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
            <h6 class="m-0 font-weight-bold text-primary">Pembayaran</h6>
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
                            <th scope="col">Metode Bayar</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($pembayaran->count() > 0)
                            @foreach ($pembayaran as $pmbyr)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $pmbyr->nama_pemesan }}</td>
                                    <td>{{ $pmbyr->tempat_perbaikan == 'dirumah' ? 'Di Rumah' : 'Di Bengkel' }}</td>
                                    <td>{{ $pmbyr->alamat == null ? '-' : $pmbyr->alamat }}</td>
                                    <td>Rp. {{ number_format($pmbyr->total + $pmbyr->total_harga_barang) }}</td>
                                    <td class="fw-bold">{{ $pmbyr->tipe_bayar == 'website' ? 'Website' : 'COD' }}</td>
                                    <td>
                                        @if ($pmbyr->status == 'Konfirmasi Layanan')
                                            <span class="badge bg-secondary text-light p-1">{{ $pmbyr->status }}</span>
                                        @elseif($pmbyr->status == 'Menunggu Konfirmasi Admin')
                                            <span
                                                class="badge fs-6 mt-2 bg-info text-light p-1">{{ $pmbyr->status }}</span>
                                        @elseif($pmbyr->status == 'Persetujuan Layanan')
                                            <span
                                                class="badge fs-6 mt-2 bg-primary text-light p-1">{{ $pmbyr->status }}</span>
                                        @elseif($pmbyr->status == 'Pembayaran')
                                            <span
                                                class="badge fs-6 mt-2 bg-warning text-light p-1">{{ $pmbyr->status }}</span>
                                        @elseif($pmbyr->status == 'Sedang Dikerjakan')
                                            <span class="badge fs-6 mt-2 text-light p-1"
                                                style="background-color: purple">{{ $pmbyr->status }}</span>
                                        @elseif($pmbyr->status == 'Selesai')
                                            <span
                                                class="badge fs-6 mt-2 bg-success text-light p-1">{{ $pmbyr->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="/layanan-admin/{{ $pmbyr->id }}"
                                                class="btn btn-primary">Detail</a>
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
            <h6 class="m-0 font-weight-bold text-primary">Sedang Dikerjakan</h6>
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
                        @if ($sedangDikerjakan->count() > 0)
                            @foreach ($sedangDikerjakan as $sdngDkrj)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $sdngDkrj->nama_pemesan }}</td>
                                    <td>{{ $sdngDkrj->tempat_perbaikan == 'dirumah' ? 'Di Rumah' : 'Di Bengkel' }}</td>
                                    <td>{{ $sdngDkrj->alamat == null ? '-' : $sdngDkrj->alamat }}</td>
                                    <td>Rp. {{ number_format($sdngDkrj->total + $sdngDkrj->total_harga_barang) }}</td>
                                    <td>
                                        @if ($sdngDkrj->status == 'Konfirmasi Layanan')
                                            <span class="badge bg-secondary text-light p-1">{{ $sdngDkrj->status }}</span>
                                        @elseif($sdngDkrj->status == 'Menunggu Konfirmasi Admin')
                                            <span
                                                class="badge fs-6 mt-2 bg-info text-light p-1">{{ $sdngDkrj->status }}</span>
                                        @elseif($sdngDkrj->status == 'Persetujuan Layanan')
                                            <span
                                                class="badge fs-6 mt-2 bg-primary text-light p-1">{{ $sdngDkrj->status }}</span>
                                        @elseif($sdngDkrj->status == 'Pembayaran')
                                            <span
                                                class="badge fs-6 mt-2 bg-warning text-light p-1">{{ $sdngDkrj->status }}</span>
                                        @elseif($sdngDkrj->status == 'Sedang Dikerjakan')
                                            <span class="badge fs-6 mt-2 text-light p-1"
                                                style="background-color: purple">{{ $sdngDkrj->status }}</span>
                                        @elseif($sdngDkrj->status == 'Selesai')
                                            <span
                                                class="badge fs-6 mt-2 bg-success text-light p-1">{{ $sdngDkrj->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="/layanan-admin/{{ $sdngDkrj->id }}"
                                                class="btn btn-primary">Detail</a>
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
            <h6 class="m-0 font-weight-bold text-primary">Selesai</h6>
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
                        @if ($selesai->count() > 0)
                            @foreach ($selesai as $sls)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $sls->nama_pemesan }}</td>
                                    <td>{{ $sls->tempat_perbaikan == 'dirumah' ? 'Di Rumah' : 'Di Bengkel' }}</td>
                                    <td>{{ $sls->alamat == null ? '-' : $sls->alamat }}</td>
                                    <td>Rp. {{ number_format($sls->total + $sls->total_harga_barang) }}</td>
                                    <td>
                                        @if ($sls->status == 'Konfirmasi Layanan')
                                            <span class="badge bg-secondary text-light p-1">{{ $sls->status }}</span>
                                        @elseif($sls->status == 'Menunggu Konfirmasi Admin')
                                            <span
                                                class="badge fs-6 mt-2 bg-info text-light p-1">{{ $sls->status }}</span>
                                        @elseif($sls->status == 'Persetujuan Layanan')
                                            <span
                                                class="badge fs-6 mt-2 bg-primary text-light p-1">{{ $sls->status }}</span>
                                        @elseif($sls->status == 'Pembayaran')
                                            <span
                                                class="badge fs-6 mt-2 bg-warning text-light p-1">{{ $sls->status }}</span>
                                        @elseif($sls->status == 'Sedang Dikerjakan')
                                            <span class="badge fs-6 mt-2 text-light p-1"
                                                style="background-color: purple">{{ $sls->status }}</span>
                                        @elseif($sls->status == 'Selesai')
                                            <span
                                                class="badge fs-6 mt-2 bg-success text-light p-1">{{ $sls->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="/layanan-admin/{{ $sls->id }}"
                                                class="btn btn-primary">Detail</a>
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
@endsection
