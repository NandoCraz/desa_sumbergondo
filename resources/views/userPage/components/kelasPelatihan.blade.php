{{-- @dd($checkouts) --}}
@extends('userPage.layouts.main')
@section('container')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <h5 style="color: bisque">Yuk Ubah Sampah Jadi Uang Dengan Pelatihan</h5>
                        <h3 style="color: bisque">Pengolahan Sampah Di Sumber Gondo</h3>
                        <p>#LikeSumberGondo</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->
    <!-- products -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success mb-3 col-lg-10" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-center" style="color: rgb(18, 56, 73)">
                                Pesan Kelas Pelatihan
                            </h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/kelas-pelatihan" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <div class="mapouter">
                                        <iframe width="100%" height="350" frameborder="0" scrolling="no"
                                            marginheight="0" marginwidth="0" id="gmap_canvas"
                                            src="https://maps.google.com/maps?width=600&amp;height=350&amp;hl=en&amp;q=Jl.%20Raya%20Sumbergondo,%20Sumbergondo,%20Kec.%20Bumiaji,%20Kota%20Batu,%20Jawa%20Timur%2065335%20+()&amp;t=&amp;z=18&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>

                                    </div>
                                    <h5 class="fw-bold my-3">Alamat Desa : Jl. Raya Sumbergondo, Sumbergondo,
                                        Kec. Bumiaji, Kota Batu, Jawa Timur 65335</h5>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-8">
                                        <label for="nama_pemesan">Nama Pemesan <span
                                                class="fw-bold text-danger">*</span></label>
                                        <input class="form-control @error('nama_pemesan') is-invalid @enderror"
                                            id="nama_pemesan" type="text" name="nama_pemesan"
                                            value="{{ old('nama_pemesan') }}" required autocomplete="off">
                                        @error('nama_pemesan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-4">
                                        <label for="waktu">Tanggal & Jam <span class="fw-bold text-danger">*</span></label>
                                        <input class="form-control selector @error('waktu') is-invalid @enderror" id="waktu"
                                            type="text" name="waktu" value="{{ old('waktu') }}" required
                                            autocomplete="off" required>
                                        @error('waktu')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-4">
                                        <label for="no_telp">No. Telepon <span class="fw-bold text-danger">*</span></label>
                                        <input class="form-control @error('no_telp') is-invalid @enderror" id="no_telp"
                                            type="text" name="no_telp" value="{{ old('no_telp') }}" required
                                            autocomplete="off">
                                        @error('no_telp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-4">
                                        <label for="tipe_bayar">Tipe Pembayaran</label>
                                        <select class="form-select" id="tipe_bayar" name="tipe_bayar">
                                            <option value="website">Melalui Website</option>
                                            <option value="ditempat">Ditempat</option>
                                        </select>
                                        @error('tipe_bayar')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2 mb-4">
                                        <label for="jumlah_orang">Jumlah Orang <span
                                                class="fw-bold text-danger">*</span></label>
                                        <input class="form-control @error('jumlah_orang') is-invalid @enderror"
                                            id="jumlah_orang" value="15" type="number" min="15" name="jumlah_orang"
                                            value="{{ old('jumlah_orang') }}" required autocomplete="off">
                                        @error('jumlah_orang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-10 mb-4">
                                        <label for="req_makan">Request Makanan</label>
                                        <input class="form-control @error('req_makan') is-invalid @enderror" id="req_makan"
                                            type="text" name="req_makan" value="{{ old('req_makan') }}" autocomplete="off">
                                        <span class="text-muted">Information : Harga makanan untuk 1 orang yaitu 25k, jika anda
                                            tidak memesan makanan, maka makanan akan disesuaikan dengan budget 25k</span>
                                        @error('req_makan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-2 mt-2 d-flex justify-content-md-end">
                                    <button type="submit" class="btn btn-outline-dark fw-bold">Pesan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <h6 class="mt-2">NOTES : Kelas Pelatihan hanya bisa dipesan minimal 1 Pack (15 Orang). Untuk info lebih
                        lanjut atau ingin bertanya silahkan <a href="https://wa.me/6281233911558">Hubungi Admin</a></h6>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();

            var maxYear = new Date().getFullYear();
            var maxMonth = new Date().getMonth() + 1;
            var maxDate = new Date().getDate() + 1;
            $(".selector").flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                minDate: "today",
                minTime: "08:00",
                maxTime: "16:00",
            });

        });
    </script>
@endsection
