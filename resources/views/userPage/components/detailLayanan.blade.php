{{-- @dd($booking->pelayanan) --}}
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
        @if (session('success'))
            <div class="container">
                <div class="alert alert-success mb-3 col-lg-12" role="alert">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <div class="container">
            <div class="card">
                <div class="card-title">
                    <h3 class="text-center mt-2">Rincian Layanan</h3>
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
                                                <span
                                                    class="badge fs-6 mt-2 bg-info text-light p-2">{{ $booking->status }}</span>
                                            </p>
                                        @elseif($booking->status == 'Persetujuan Layanan')
                                            <p>
                                                <span
                                                    class="badge fs-6 mt-2 bg-primary text-light p-2">{{ $booking->status }}</span>
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
                                                    @if ($booking->status == 'Konfirmasi Layanan')
                                                        <th scope="col">Aksi</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($booking->pelayanan as $pelayanan)
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ $pelayanan->nama_pelayanan }}</td>
                                                        <td>Rp. {{ number_format($pelayanan->harga) }}</td>
                                                        @if ($booking->status == 'Konfirmasi Layanan')
                                                            <td>
                                                                <form action="/pelayanan/hapus/{{ $pelayanan->pivot->id }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $booking->id }}">
                                                                    <button class="btn btn-sm btn-danger"><i
                                                                            class="fas fa-solid fa-trash"></i></button>
                                                                </form>
                                                            </td>
                                                        @endif
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
                                                            Pelayanan
                                                            ({{ $booking->upd_biaya == true ? 'Akhir' : 'Sementara' }})</span>
                                                        : Rp. {{ number_format($booking->total) }}
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
                                                    @if ($booking->status == 'Konfirmasi Layanan')
                                                        <th scope="col">Aksi</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($booking->barang as $barang)
                                                    <tr>
                                                        <th><img src="{{ asset('storage/' . $barang->picture_barang) }}"
                                                                alt="{{ $booking->nama_barang }}" width="40"></th>
                                                        <td>{{ $barang->nama_barang }}</td>
                                                        <td>Rp. {{ number_format($barang->harga) }}</td>
                                                        @if ($booking->status == 'Konfirmasi Layanan')
                                                            <td>
                                                                <form action="/layananBarang/{{ $barang->pivot->id }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('patch')
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $booking->id }}">
                                                                    <input type="number" name="kuantitas" class="kuantitas"
                                                                        id="kuantitas" data-id="{{ $barang->pivot->id }}"
                                                                        value="{{ $barang->pivot->kuantitas }}">
                                                                </form>
                                                            </td>
                                                        @else
                                                            <td>{{ $barang->kuantitas }}</td>
                                                        @endif
                                                        @if ($booking->status == 'Konfirmasi Layanan')
                                                            <td>
                                                                <form
                                                                    action="/layananBarang/hapus/{{ $barang->pivot->id }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $booking->id }}">
                                                                    <button class="btn btn-sm btn-danger"><i
                                                                            class="fas fa-solid fa-trash"></i></button>
                                                                </form>
                                                            </td>
                                                        @endif
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
                                        Total Biaya ({{ $booking->upd_biaya == true ? 'Akhir' : 'Sementara' }}) : Rp.
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
                            @if ($booking->status == 'Konfirmasi Layanan')
                                <div class="d-flex">
                                    <form action="/hapusLayanan/{{ $booking->id }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Batalkan</button>
                                    </form>
                                    <form action="/changeLayanan/{{ $booking->id }}" method="post">
                                        @csrf
                                        <input type="hidden" name="status" value="konfirmasi">
                                        <button type="submit" class="btn btn-primary ms-3">Konfirmasi</button>
                                    </form>
                                </div>
                            @elseif($booking->status == 'Persetujuan Layanan')
                                <form action="/changeLayanan/{{ $booking->id }}" method="post">
                                    @csrf
                                    <input type="hidden" name="status" value="deal">
                                    <button type="submit" class="btn btn-success fw-bold fs-4 ms-3">Deal</button>
                                </form>
                            @endif
                        </div>
                        @if ($booking->status == 'Persetujuan Layanan')
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="/penawaran/{{ $booking->id }}" method="post">
                                            @csrf
                                            <div class="mb-4">
                                                <label for="penawaran" class="fw-bold">Ajukan Penawaran (Untuk Biaya
                                                    Pelayanan)</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            Rp.
                                                        </span>
                                                    </div>
                                                    <input class="form-control @error('penawaran') is-invalid @enderror"
                                                        id="penawaran" type="text" name="penawaran"
                                                        value="{{ old('penawaran') }}" required autocomplete="off">
                                                </div>
                                                @error('penawaran')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="d-flex">
                                                @if ($booking->status_penawaran != 'Disetujui' || $booking->penawaran_3 != null)
                                                    <button type="submit" class="btn btn-dark">Ajukan</button>
                                                @endif
                                                @if ($booking->status_penawaran == 'Ditolak')
                                                    <div class="text-danger ms-4 fw-bold fs-5">Ditolak</div>
                                                @elseif($booking->status_penawaran == 'Disetujui')
                                                    <div class="text-success ms-4 fw-bold fs-5">Disetujui</div>
                                                @elseif($booking->status_penawaran == 'Diajukan')
                                                    <div class="text-secondary ms-4 fw-bold fs-5">Diajukan</div>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
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

    <script>
        function debounce(func, timeout = 1000) {
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    func.apply(this, args);
                }, timeout);
            };
        }

        document.querySelectorAll('.kuantitas').forEach(item => {
            item.addEventListener('input', debounce(function() {
                const id = item.dataset.id;
                const kuantitas = item.value;
                const idBooking = $('input[name="id"]').val();
                const url = `/layananBarang/${id}`;
                $.ajax({
                    url: url,
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{ @csrf_token() }}'
                    },
                    data: {
                        kuantitas: kuantitas,
                        id: idBooking
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            }, 1000));
        });
    </script>
@endsection
