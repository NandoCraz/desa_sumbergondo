@extends('adminPage.layouts.main')
@section('content')
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-primary">
                        Tambah Barang
                    </h4>
                </div>
                <div class="card-body">

                    <form method="POST" action="/master/data-barang" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-5 mb-4">
                                <label for="nama_barang">Nama</label>
                                <input class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang"
                                    type="text" name="nama_barang" value="{{ old('nama_barang') }}" required
                                    autocomplete="off">
                                @error('nama_barang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-3 mb-4">
                                <label for="berat">Berat Barang</label>
                                <div class="input-group">
                                    <input name="berat" id="berat" type="number"
                                        class="form-control @error('berat') is-invalid @enderror" value="{{ old('berat') }}"
                                        min="0" />
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            Gram
                                        </span>
                                    </div>
                                </div>
                                @error('berat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-4 mb-4">
                                <label for="harga">Harga</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            Rp.
                                        </span>
                                    </div>
                                    <input class="form-control @error('harga') is-invalid @enderror" id="harga"
                                        type="text" name="harga" value="{{ old('harga') }}" required autocomplete="off">
                                </div>
                                @error('harga')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-2 mb-2">
                                <label for="stok">Stok</label>
                                <input class="form-control @error('stok') is-invalid @enderror" id="stok" type="number"
                                    name="stok" value="{{ old('stok') }}" required autocomplete="off">
                                @error('stok')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-5 mb-2">
                                <label class="form-control-label">Kategori <p class="text-muted fs-6">(Masukkan setidaknya 1
                                        kategori)
                                    </p></label>
                                <div class="row">
                                    @foreach ($kategoris as $kategori)
                                        <div class="col-lg-2">
                                            <div class="form-check">
                                                @if (old('kategori') == $kategori->id)
                                                    <input class="form-check-input" type="checkbox" value="{{ $kategori->id }}"
                                                        id="kategori" name="kategori[]" checked>
                                                @else
                                                    <input class="form-check-input" type="checkbox" value="{{ $kategori->id }}"
                                                        id="kategori" name="kategori[]">
                                                @endif
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    {{ $kategori->nama_kategori }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-5 mb-2">
                                <label for="imageFile" class="form-label">Barang Picture</label>
                                <img class="imgPreview img-fluid col-sm-5 d-block mb-3" style="width: 100px">
                                <input type="file" class="form-control @error('picture_barang') is-invalid @enderror"
                                    name="picture_barang" id="imageFile" onchange="tampilImage()">
                                @error('picture_barang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" style="resize: none"></textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-right mb-2 mt-2">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
    <a href="/master/data-barang" class=" btn btn-secondary text-decoration-none my-2">Kembali</a>

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
