@extends('adminPage.layouts.main')
@section('content')
    @if (session('success'))
        <div class="alert alert-success mb-3 col-lg-10" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <a href="javascript:history.back()" class="btn btn-danger mb-4"><i class="fa fa-chevron-left" aria-hidden="true"></i>
        Kembali</a>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Pesanan</h6>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5>
                                Status :
                                @if ($booking->status == 'Konfirmasi Layanan')
                                    <p>
                                        <span class="badge fs-6 mt-2 bg-secondary p-2">{{ $booking->status }}</span>
                                    </p>
                                @elseif($booking->status == 'Menunggu Konfirmasi Admin')
                                    <p>
                                        <span class="badge fs-6 mt-2 bg-info text-light p-2">{{ $booking->status }}</span>
                                    </p>
                                @endif
                            </h5>
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
                            @if ($booking->tempat_perbaikan == 'dibengkel')
                                <h5>Alamat Bengkel : <p>Jl. Rangkah VII/124B, Surabaya</p>
                                </h5>
                            @endif
                            <h5>Waktu (Tanggal & Jam) : <p>{{ $booking->waktu }}</p>
                            </h5>
                            <h5>Tipe Pembayaran : <p>
                                    {{ $booking->tipe_bayar == 'website' ? 'Melalui Website' : 'COD' }}</p>
                            </h5>
                            <h5>
                                Montir Pengerjaan :
                                <p>{{ $booking->montir->nama }} | {{ $booking->montir->no_telp }}</p>
                                <p><img src="{{ asset('storage/' . $booking->montir->picture_montir) }}"
                                        alt="{{ $booking->montir->nama }}" class="rounded" width="120"></p>
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
                                            <td colspan="4"><span class="fw-bold fs-6">Kendala Lain</span>
                                                : {{ $booking->kendala == null ? '-' : $booking->kendala }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><span class="fw-bold fs-6">Total Biaya
                                                    Pelayanan</span> : Rp. {{ number_format($booking->total) }}
                                            </td>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($booking->barang as $barang)
                                            <tr>
                                                <th><img src="{{ asset('storage/' . $barang->picture_barang) }}"
                                                        alt="{{ $booking->nama_barang }}" width="40"></th>
                                                <td>{{ $barang->nama_barang }}</td>
                                                <td>Rp. {{ number_format($barang->harga) }}</td>
                                                <td>{{ $barang->kuantitas }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5"><span class="fw-bold fs-6">Total Harga Barang</span>
                                                : Rp. {{ number_format($booking->total_harga_barang) }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer mt-3">
                            <h4>
                                Total Biaya (Sementara) : Rp.
                                {{ number_format($booking->total + $booking->total_harga_barang) }}
                            </h4>
                        </div>
                    </div>
                    {{-- @if ($checkout->payment_status == '1')
                        <button class="btn btn-lg btn-warning text-light mt-4" id="bayar">Bayar</button>
                    @endif --}}
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-6">
                    @if ($booking->status == 'Menunggu Konfirmasi Admin')
                        <div class="d-flex">
                            <form action="/changeLayanan/{{ $booking->id }}" method="post">
                                @csrf
                                <input type="hidden" name="status" value="konfirmasiAdmin">
                                <button type="submit" class="btn btn-primary ms-3">Konfirmasi</button>
                            </form>
                        </div>
                    @endif
                </div>
                @if ($booking->status == 'Menunggu Konfirmasi Admin')
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <form action="/hargaAkhir/{{ $booking->id }}" method="post">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="harga_akhir" class="fw-bold">Tetapkan Biaya (Untuk Biaya
                                            Pelayanan)</label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    Rp.
                                                </span>
                                            </div>
                                            <input class="form-control @error('harga_akhir') is-invalid @enderror"
                                                id="harga_akhir" type="text" name="harga_akhir"
                                                value="{{ old('harga_akhir', $booking->upd_biaya == true ? $booking->total : '') }}"
                                                required autocomplete="off"
                                                {{ $booking->upd_biaya == true ? 'readonly' : '' }}>
                                        </div>
                                        @error('harga_akhir')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    @if ($booking->upd_biaya == false)
                                        <button type="submit" class="btn btn-primary">Ubah</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($booking->status == 'Persetujuan Layanan' &&
                    ($booking->penawaran_1 != null || $booking->penawaran_2 != null || $booking->penawaran_3 != null))
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <form action="/keputusan/{{ $booking->id }}" method="post">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="penawaran" class="fw-bold">Customer Mengajukan (Untuk Biaya
                                            Pelayanan)</label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    Rp.
                                                </span>
                                            </div>
                                            @if ($booking->penawaran_1 != null && $booking->penawaran_2 == null)
                                                <input class="form-control" id="penawaran" type="text"
                                                    value="{{ $booking->penawaran_1 }}" readonly autocomplete="off">
                                            @elseif($booking->penawaran_1 != null && $booking->penawaran_2 != null)
                                                <input class="form-control" id="penawaran" type="text"
                                                    value="{{ $booking->penawaran_2 }}" readonly autocomplete="off">
                                            @elseif($booking->penawaran_2 != null && $booking->penawaran_3 != null)
                                                <input class="form-control" id="penawaran" type="text"
                                                    value="{{ $booking->penawaran_3 }}" readonly autocomplete="off">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <button type="submit" name="tolak" class="btn btn-danger">Tolak</button>
                                        <button type="submit" name="setuju" class="btn btn-success">Setuju</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
