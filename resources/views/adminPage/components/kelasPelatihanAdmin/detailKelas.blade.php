@extends('adminPage.layouts.main')
@section('content')
    {{-- @if (session('success'))
        <div class="alert alert-success mb-3 col-lg-10" role="alert">
            {{ session('success') }}
        </div>
    @endif --}}
    <a href="/pelatihan-admin" class="btn btn-danger mb-4"><i class="fa fa-chevron-left" aria-hidden="true"></i>
        Kembali</a>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Layanan</h6>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="font-weight-bold">
                                Status :
                                @if ($pelatihan->tipe_bayar == 'ditempat')
                                    @if ($pelatihan->status == 'Menunggu Konfirmasi')
                                        <p>
                                            <span
                                                class="badge fs-6 mt-2 text-light bg-secondary p-2">{{ $pelatihan->status }}</span>
                                        </p>
                                    @elseif($pelatihan->status == 'Dikonfirmasi')
                                        <p>
                                            <span class="badge fs-6 mt-2 text-light p-2"
                                                style="background-color: purple">Belum Dibayar</span>
                                        </p>
                                    @elseif($pelatihan->status == 'Sudah Dibayar')
                                        <p>
                                            <span
                                                class="badge fs-6 mt-2 bg-success text-light p-1">{{ $pelatihan->status }}</span>
                                        </p>
                                    @elseif($pelatihan->status == 'Dibatalkan')
                                        <p>
                                            <span
                                                class="badge fs-6 mt-2 bg-danger text-light p-1">{{ $pelatihan->status }}</span>
                                        </p>
                                    @endif
                                @else
                                    @if ($pelatihan->payment_status == '1')
                                        <p>
                                            <span class="badge fs-6 mt-2 text-light p-1"
                                                style="background-color: purple">Belum Dibayar</span>
                                        </p>
                                    @elseif($pelatihan->payment_status == '2')
                                        <p>
                                            <span class="badge fs-6 mt-2 bg-success text-light p-1">Sudah Dibayar</span>
                                        </p>
                                    @else
                                        <p>
                                            <span class="badge fs-6 mt-2 bg-danger text-light p-1">Kadaluarsa</span>
                                        </p>
                                    @endif
                                @endif
                            </h5>
                            <h5 class="font-weight-bold">Nama Pemesan : <p>{{ $pelatihan->nama_pemesan }}</p>
                            </h5>
                            <h5 class="font-weight-bold">No. Telepon : <p>{{ $pelatihan->no_telp }}</p>
                            </h5>

                            <h5 class="font-weight-bold">Waktu (Tanggal & Jam) : <p>{{ $pelatihan->waktu }}</p>
                            </h5>
                            <h5 class="font-weight-bold">Request Makanan : <p>
                                    {{ $pelatihan->req_makan }}</p>
                            </h5>
                            <h5 class="font-weight-bold">Total Harga : <p>
                                    Rp. {{ number_format($pelatihan->total) }}</p>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-6">
                    @if ($pelatihan->status == 'Menunggu Konfirmasi')
                        <div class="d-flex">
                            <form action="/changeKelasStatus/{{ $pelatihan->id }}" method="post">
                                @csrf
                                <input type="hidden" name="status" value="konfirmasiAdmin">
                                <button type="submit" class="btn btn-primary ms-3">Konfirmasi</button>
                            </form>
                        </div>
                    @elseif($pelatihan->status == 'Dikonfirmasi')
                        <div class="d-flex">
                            <form action="/changeKelasStatus/{{ $pelatihan->id }}" method="post">
                                @csrf
                                <input type="hidden" name="status" value="sudahDibayar">
                                <button type="submit" class="btn btn-primary ms-3">Sudah Bayar</button>
                            </form>
                        </div>
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
