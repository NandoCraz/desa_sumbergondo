@extends('adminPage.layouts.main')
@section('content')
    <a href="/master/data-montir" class=" btn btn-secondary text-decoration-none my-4">Kembali</a>
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-primary">
                        Tambah Montir
                    </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="/master/data-montir" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="nama">Nama</label>
                            <input class="form-control @error('nama') is-invalid @enderror" id="nama" type="text"
                                name="nama" value="{{ old('nama') }}" required autocomplete="off">
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="alamat">Alamat</label>
                            <input class="form-control @error('alamat') is-invalid @enderror" id="alamat" type="text"
                                name="alamat" value="{{ old('alamat') }}" required autocomplete="off">
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="no_telp">No. Telepon</label>
                            <input class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" type="text"
                                name="no_telp" value="{{ old('no_telp') }}" required autocomplete="off">
                            @error('no_telp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="imageFile" class="form-label">Foto montir</label>
                            <img class="imgPreview img-fluid col-sm-5 d-block mb-3" style="width: 100px">
                            <input type="file" class="form-control @error('picture_montir') is-invalid @enderror"
                                name="picture_montir" id="imageFile" onchange="tampilImage()">
                            @error('picture_montir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-4 mt-5">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function tampilImage() {
            const image = document.querySelector('#imageFile');
            const imgPreview = document.querySelector('.imgPreview');

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
