{{-- @dd($checkouts) --}}
@extends('userPage.layouts.main')
@section('container')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>#LikeSumberGondo</p>
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
            {{-- @if (session('success'))
                <div class="alert alert-success mb-3 col-lg-10" role="alert">
                    {{ session('success') }}
                </div>
            @endif --}}
            <div class="table-responsive">
                <table class="table stripe" id="dataTable">
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
                        @if ($checkouts->count() > 0)
                            @foreach ($checkouts as $checkout)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $checkout->daftarAlamat->nama_penerima }}</td>
                                    <td>{{ $checkout->daftarAlamat->alamat }},
                                        {{ $checkout->daftarAlamat->kode_pos }},
                                        {{ $checkout->daftarAlamat->provinsi->nama_provinsi }},
                                        {{ $checkout->daftarAlamat->kota->nama_kab_kota }}</td>
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
                                        @if ($checkout->payment_status != '3' && $checkout->status != '5')
                                            <a href="/pesanan/{{ $checkout->uuid }}" class="btn btn-primary">Detail</a>
                                        @endif
                                        @if ($checkout->status == '5' || $checkout->payment_status == '3' || $checkout->status == '4')
                                            <form action="/changeStatus/{{ $checkout->uuid }}" method="post"
                                                class="ms-2">
                                                @csrf
                                                <input type="hidden" name="action" value="hapus">
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        @endif
                                        @if ($checkout->payment_status == '1' && $checkout->status != '5')
                                            <form action="/changeStatus/{{ $checkout->uuid }}" method="post"
                                                class="ms-2">
                                                @csrf
                                                <input type="hidden" name="action" value="batal">
                                                <input type="hidden" name="id" value="{{ $checkout->id }}">
                                                <button type="submit" class="btn btn-danger">Batalkan</button>
                                            </form>
                                        @endif
                                        @if ($checkout->status == '3')
                                            <form action="/changeStatus/{{ $checkout->uuid }}" method="post"
                                                class="ms-2">
                                                @csrf
                                                <input type="hidden" name="action" value="terima">
                                                <button type="submit" class="btn btn-success">Diterima</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">Anda Belum Memesan..</td>
                            </tr>
                        @endif
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
