{{-- @dd($checkouts) --}}
@extends('userPage.layouts.main')
@section('container')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Perbaiki & Modifikasi</p>
                        <h1>Booking Layanan</h1>
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
                    <div class="card mb-3">
                        <div class="card-body">
                            <h6><span class="fw-bold text-danger">*</span><span class="fw-bold">Note : </span>
                            </h6>
                            <div>
                                <p class="text-muted">- Selain dari pelayanan, harga akan ditentukan dari pihak admin.</p>
                            </div>
                            <div>
                                <p class="text-muted">- Pelayanan Service hanya untuk sekitar Kota Surabaya.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-primary">
                                Pesan Layanan
                            </h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/booking" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label for="tempat_perbaikan">Tempat Perbaikan</label>
                                            <select class="form-select" id="tempat_perbaikan" name="tempat_perbaikan">
                                                <option value="dirumah">Perbaikan di Rumah</option>
                                                <option value="dibengkel">Perbaikan di Bengkel</option>
                                            </select>
                                            @error('tempat_perbaikan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="tipe_bayar">Tipe Pembayaran</label>
                                            <select class="form-select" id="tipe_bayar" name="tipe_bayar">
                                                <option value="website">Melalui Website</option>
                                                <option value="cod">COD</option>
                                            </select>
                                            @error('tipe_bayar')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
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
                                <div class="mb-4 d-none" id="peta">
                                    <div class="mapouter">
                                        <div class="gmap_canvas"><iframe class="w-100" height="400" id="gmap_canvas"
                                                src="https://maps.google.com/maps?q=Rangkah%20VII/124&t=&z=19&ie=UTF8&iwloc=&output=embed"
                                                frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a
                                                href="https://putlocker-is.org"></a><br>
                                            <style>
                                                .mapouter {
                                                    position: relative;
                                                    text-align: right;
                                                    height: 400px;
                                                    width: 100%px;
                                                }
                                            </style><a href="https://www.embedgooglemap.net">embed google maps on
                                                website</a>
                                            <style>
                                                .gmap_canvas {
                                                    overflow: hidden;
                                                    background: none !important;
                                                    height: 400px;
                                                    width: 100%;
                                                }
                                            </style>
                                        </div>
                                    </div>
                                    <h4 class="fw-bold my-3">Alamat Bengkel : Jl. Rangkah VII/124, Surabaya</h4>
                                </div>
                                <div id="rumah">
                                    <div class="mb-4">
                                        <label for="alamat">Alamat <span class="fw-bold text-danger">*</span></label>
                                        <div class="input-group">
                                            <input class="form-control w-75 @error('alamat') is-invalid @enderror"
                                                id="alamat" type="text" name="alamat" value="{{ old('alamat') }}"
                                                autocomplete="off">
                                        </div>
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="kecamatan_id">Kecamatan <span
                                                class="fw-bold text-danger">*</span></label>
                                        <select class="form-control" name="kecamatan_id">
                                            <option value="">-- Pilih Kecamatan --</option>
                                            @foreach ($kecamatans as $kecamatan)
                                                <option value="{{ $kecamatan->id }}">{{ $kecamatan->nama_kecamatan }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kecamatan_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="kode_pos">Kode Pos <span class="fw-bold text-danger">*</span></label>
                                        <div class="input-group">
                                            <input class="form-control w-75 @error('kode_pos') is-invalid @enderror"
                                                id="kode_pos" type="text" name="kode_pos" value="{{ old('kode_pos') }}"
                                                autocomplete="off">
                                        </div>
                                        @error('kode_pos')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
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
                                <div class="mb-4">
                                    <label for="tipe_mobil">Tipe Mobil <span class="fw-bold text-danger">*</span></label>
                                    <select class="form-control" name="tipe_mobil" required>
                                        <option value="">-- Pilih Tipe Mobil --</option>
                                        <option value="Mobil SUV">Mobil SUV</option>
                                        <option value="Mobil MPV">Mobil MPV</option>
                                        <option value="Mobil Crossover">Mobil Crossover</option>
                                        <option value="Mobil Hatchback">Mobil Hatchback</option>
                                        <option value="Mobil Sedan">Mobil Sedan</option>
                                        <option value="Mobil Sport Edan">Mobil Sport Sedan</option>
                                        <option value="Mobil Convertible">Mobil Convertible</option>
                                        <option value="Mobil Station Wagon">Mobil Station Wagon</option>
                                        <option value="Mobil Off Road">Mobil Off Road</option>
                                        <option value="Mobil Pickup Truck & Mobil Double Cabin">Mobil Pickup Truck & Mobil
                                            Double Cabin</option>
                                        <option value="Mobil Elektrik">Mobil Elektrik</option>
                                        <option value="Mobil Hybrid">Mobil Hybrid</option>
                                        <option value="Mobil LCGC">Mobil LCGC</option>
                                    </select>
                                    @error('tipe_mobil')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="pelayanan_id" class="d-block">Pelayanan</label>
                                    <select class="js-example-basic-multiple w-100" id="pelayanan_id"
                                        name="pelayanan_id[]" multiple="multiple">
                                        @foreach ($pelayanans as $pelayanan)
                                            <option value="{{ $pelayanan->id }}">{{ $pelayanan->nama_pelayanan }} |
                                                Rp. {{ number_format($pelayanan->harga) }}</option>
                                        @endforeach
                                    </select>
                                    @error('pelayanan_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="barang_id" class="d-block">Beli Sparepart</label>
                                    <select class="js-example-basic-multiple w-100" id="barang_id" name="barang_id[]"
                                        multiple="multiple">
                                        @foreach ($barangs as $barang)
                                            <option value="{{ $barang->id }}">{{ $barang->nama_barang }} |
                                                Rp. {{ number_format($barang->harga) }}</option>
                                        @endforeach
                                    </select>
                                    @error('barang_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="montir_id">Montir Pengerjaan <span
                                            class="fw-bold text-danger">*</span></label>
                                    <select class="form-control" name="montir_id" required>
                                        <option value="">-- Pilih Montir --</option>
                                        @if ($montirs->count() > 0)
                                            @foreach ($montirs as $montir)
                                                <option {{ $montir->is_tersedia == false ? 'disabled' : '' }}
                                                    value="{{ $montir->id }}">{{ $montir->nama }}
                                                    {{ $montir->is_tersedia == false ? '(Dalam Pengerjaan)' : '' }}
                                                </option>
                                            @endforeach
                                        @else
                                            <option disabled>Tidak ada montir yang tersedia.</option>
                                        @endif
                                    </select>
                                    @error('montir_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="waktu">Tanggal & Jam <span class="fw-bold text-danger">*</span></label>
                                    <input class="form-control selector @error('waktu') is-invalid @enderror"
                                        id="waktu" type="text" name="waktu" value="{{ old('waktu') }}"
                                        required autocomplete="off" required>
                                    @error('waktu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="kendala" class="form-label">Kendala Lain <span class="fw-bold">(** Diisi
                                            apabila kendala
                                            tidak
                                            tersedia
                                            pada layanan **)</span></label>
                                    <textarea class="form-control" id="kendala" name="kendala" rows="3" style="resize: none"></textarea>
                                    @error('kendala')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-4 row">
                                    <div class="col-lg-8 mb-4">
                                        <h5>Lampiran Foto Mobil (Bila Diperlukan)</h5>
                                    </div>
                                    <div class="col-lg-12 mb-3 row">
                                        <div class="col-lg-6 mb-3">
                                            <label for="imageFile" class="form-label">Lampiran 1</label>
                                            <img class="imgPreview img-fluid col-sm-5 d-block mb-3" style="width: 150px">
                                            <input type="file"
                                                class="form-control @error('lampiran_1') is-invalid @enderror"
                                                name="lampiran_1" id="imageFile" onchange="tampilImage()">
                                            @error('lampiran_1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="imageFile" class="form-label">Lampiran 2</label>
                                            <img class="imgPreview2 img-fluid col-sm-5 d-block mb-3" style="width: 150px">
                                            <input type="file"
                                                class="form-control @error('lampiran_2') is-invalid @enderror"
                                                name="lampiran_2" id="imageFile2" onchange="tampilImage2()">
                                            @error('lampiran_2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 row">
                                        <div class="col-lg-6 mb-3">
                                            <label for="imageFile" class="form-label">Lampiran 3</label>
                                            <img class="imgPreview3 img-fluid col-sm-5 d-block mb-3" style="width: 150px">
                                            <input type="file"
                                                class="form-control @error('lampiran_3') is-invalid @enderror"
                                                name="lampiran_3" id="imageFile3" onchange="tampilImage3()">
                                            @error('lampiran_3')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="imageFile" class="form-label">Lampiran 4</label>
                                            <img class="imgPreview4 img-fluid col-sm-5 d-block mb-3" style="width: 150px">
                                            <input type="file"
                                                class="form-control @error('lampiran_4') is-invalid @enderror"
                                                name="lampiran_4" id="imageFile4" onchange="tampilImage4()">
                                            @error('lampiran_4')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4 mt-5">
                                    <button type="submit" class="btn btn-primary">Pesan</button>
                                </div>
                            </form>
                        </div>
                    </div>
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
                maxDate: maxYear + "." + maxMonth + "." + maxDate,
                minTime: "09:00",
                maxTime: "16:00",
                disable: [
                    function(date) {
                        return (date.getDay() === 0 || date.getDay() === 6);
                    }
                ],
                locale: {
                    "firstDayOfWeek": 1
                }
            });

        });

        function tampilImage() {
            const image = document.querySelector('#imageFile');
            const imgPreview = document.querySelector('.imgPreview');

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function tampilImage2() {
            const image = document.querySelector('#imageFile2');
            const imgPreview = document.querySelector('.imgPreview2');

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function tampilImage3() {
            const image = document.querySelector('#imageFile3');
            const imgPreview = document.querySelector('.imgPreview3');

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function tampilImage4() {
            const image = document.querySelector('#imageFile4');
            const imgPreview = document.querySelector('.imgPreview4');

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        // function initialize() {
        //     var propertiPeta = {
        //         center: new google.maps.LatLng(-7.245709, 112.766343),
        //         zoom: 18,
        //         mapTypeId: google.maps.MapTypeId.ROADMAP
        //     };

        //     var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
        // }

        $('#tempat_perbaikan').on('change', function(e) {
            const rumah = $('#rumah');
            const peta = $('#peta');

            if (this.value == 'dibengkel') {
                // console.log(initialize);
                rumah.addClass('d-none');
                peta.removeClass('d-none');
                // initialize();

            } else if (this.value == 'dirumah') {
                rumah.removeClass('d-none');
                peta.addClass('d-none');
            }
        })
    </script>
@endsection
