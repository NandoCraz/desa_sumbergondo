{{-- @dd($booking->barang) --}}
@extends('userPage.layouts.main')
@section('container')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Perbaiki & Modifikasi</p>
                        <h1>Detail Layanan</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->
    <!-- products -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="card">
                <div class="card-title">
                    <h3 class="text-center mt-2">Rincian Layanan</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Nama Pemesan : <p>{{ $booking->nama_pemesan }}</p>
                                    </h5>
                                    <h5>No. Telepon : <p>{{ $booking->no_telp }}</p>
                                    </h5>
                                    <h5>Alamat : <p>{{ $booking->alamat == null ? '-' : $booking->alamat }}</p>
                                    </h5>
                                    <h5>Tipe Mobil : <p>{{ $booking->tipe_mobil }}</p>
                                    </h5>
                                    <h5>Tempat Perbaikan : <p>
                                            {{ $booking->tempat_perbaikan == 'dirumah' ? 'Di Rumah' : ' Di Bengkel' }}</p>
                                    </h5>
                                    <h5>Waktu (Tanggal & Jam) : <p>{{ $booking->waktu }}</p>
                                    </h5>
                                    <h5>Tipe Pembayaran : <p>
                                            {{ $booking->tipe_bayar == 'website' ? 'Melalui Website' : 'COD' }}</p>
                                    </h5>
                                    <h5>
                                        Montir Pengerjaan :
                                        <p>{{ $booking->montir->nama }}</p>
                                        <p><img src="{{ asset('storage/' . $booking->montir->picture_montir) }}"
                                                alt="{{ $booking->montir->nama }}" class="rounded" width="120"></p>
                                    </h5>
                                    <h5>
                                        Status :
                                        @if ($booking->status == 'Menunggu Konfirmasi')
                                            <p>
                                                <span class="badge bg-secondary p-2">{{ $booking->status }}</span>
                                            </p>
                                        @endif

                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive mb-5">
                                        <table class="table">
                                            <h5>Pelayanan Dipesan</h5>
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nama Pelayanan</th>
                                                    <th scope="col">Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($booking->pelayanan as $pelayanan)
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ $pelayanan->nama_pelayanan }}</td>
                                                        <td>Rp. {{ number_format($pelayanan->harga) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot class="mt-4">
                                                <tr>
                                                    <td colspan="3"><span class="fw-bold fs-6">Kendala Lain</span>
                                                        : {{ $booking->kendala }}</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <h5>Barang Dipesan</h5>
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col">Nama Barang</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Kuantitas</th>
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($booking->barang as $barang)
                                                    <tr>
                                                        <th><img src="{{ asset('storage/' . $barang->picture_barang) }}"
                                                                alt="{{ $booking->nama_barang }}" width="40"></th>
                                                        <td>{{ $barang->nama_barang }}</td>
                                                        <td>Rp. {{ number_format($barang->harga) }}</td>
                                                        <td>{{ $barang->pivot->kuantitas }}</td>
                                                        <td>Hapus</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            {{-- @if ($checkout->payment_status == '1')
                                <button class="btn btn-lg btn-warning text-light mt-4" id="bayar">Bayar</button>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end products -->
@endsection

@section('script')
    {{-- <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    @if ($checkout->payment_status == '1')
        <script>
            $('#bayar').on('click', function(e) {
                e.preventDefault();
                snap.pay('{{ $checkout->snap_token }}', {
                    onSuccess: function(result) {
                        console.log(result);
                        window.location.href = '/pesanan'
                    }
                });
            })
        </script>
    @endif --}}
@endsection
