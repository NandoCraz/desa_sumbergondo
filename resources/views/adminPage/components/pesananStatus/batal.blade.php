{{-- @dd($checkoutsDel) --}}
@extends('adminPage.layouts.main')
@section('content')
    {{-- @if (session('berhasil'))
        <div class="alert alert-success mb-3 col-lg-10" role="alert">
            {{ session('berhasil') }}
        </div>
    @endif --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pesanan Dibatalkan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Nama Penerima</th>
                            <th>Alamat</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($checkouts as $checkout)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $checkout->daftarAlamat->nama_penerima }}</td>
                                <td>{{ $checkout->daftarAlamat->alamat }},
                                    {{ $checkout->daftarAlamat->kode_pos }},
                                    {{ $checkout->daftarAlamat->provinsi->nama_provinsi }},
                                    {{ $checkout->daftarAlamat->kota->nama_kab_kota }}</td>
                                <td>Rp. {{ number_format($checkout->total) }}</td>
                                @if ($checkout->status == '5')
                                    <td>
                                        <h5><span class="badge bg-danger text-light">Dibatalkan</span></h5>
                                    </td>
                                @endif
                                <td>
                                    <a href="/pesanan/admin/{{ $checkout->id }}" class="btn btn-primary btn-sm">Detail</a>
                                </td>
                            </tr>
                        @endforeach
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
