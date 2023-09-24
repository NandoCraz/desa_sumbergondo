{{-- @dd($checkoutsDel) --}}
@extends('adminPage.layouts.main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="container-xl px-4 mt-4">
                <div class="row">
                    <div class="col-xl-4">
                        <!-- Profile picture card-->
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-header" style="font-weight: 700">Foto Profile</div>
                            <div class="card-body text-center">
                                <form method="POST" action="/proses-akun" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Profile picture image-->
                                    <img class="imgPreview img-profile mb-2"
                                        src="{{ asset('storage/profilePicture/userDef.png') }}" width="170">

                                    <div class="input-group mb-3">
                                        <input class="form-control mt-4 @error('picture_profile') is-invalid @enderror"
                                            name="picture_profile" type="file" id="imageFile" onchange="tampilImage()">
                                        @error('picture_profile')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <!-- Profile picture help block-->
                                    <div class="small font-italic text-muted mb-4">JPG, PNG, JPEG tidak lebih 2 MB
                                    </div>
                                    <!-- Profile picture upload button-->
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <!-- Account details card-->
                        <div class="card mb-1">
                            <div class="card-header" style="font-weight: 700">User Details</div>
                            <div class="card-body">
                                <input type="hidden" name="role" value="keluarga">
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label class="small mb-1" for="nama">Nama</label>
                                        <input class="form-control @error('name') is-invalid @enderror" id="nama"
                                            name="name" type="text" placeholder="Masukkan nama" required />
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-6">
                                    <label class="small mb-1" for="username">Username</label>
                                    <input class="form-control" name="username" id="username" type="text" />
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <select class="form-select" required name="bank_id" id="bank_id">
                                            <option value="">-- Pilih Bank --</option>
                                            @foreach ($banks as $bank)
                                                <option value="{{ $bank->id }}">{{ $bank->nama_bank }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <select class="form-select" required name="rw" id="rw">
                                            <option value="">-- Pilih RW --</option>
                                            @foreach ($wargas as $warga)
                                                <option value="{{ $warga->id }}">{{ $warga->nomor_rw }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <select class="form-select" required name="rt" id="rt">
                                            <option value="">-- Pilih RT --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8 mb-3">
                                        <label class="small col-8 mb-1" for="email">Email</label>
                                        <input class="form-control" id="email" type="email" name="email" />
                                    </div>
                                    <div class="col-4 mb-3">
                                        <label class="small mb-1" for="no_hp">No. Handphone</label>
                                        <input class="form-control" name="no_hp" id="no_hp" type="text" />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1" for="password">Password</label>
                                    <input class="form-control" id="password" type="password" name="password" />
                                </div>

                                <div class="mb-3">
                                    <label class="small mb-1" for="c_password">Confirm Password</label>
                                    <input class="form-control" id="c_password" type="password" name="c_password" />
                                </div>

                                <!-- Submit button-->
                                <div class="text-right mt-2">
                                    <button class="btn btn-success btn-outline-dark" style="font-weight: 700" type="submit">Simpan Perubahan</button>
                                </div>
                                </form>

                            </div>
                        </div>
                        <div class="mb-4">
                            <a href="/seluruh-user" class=" btn btn-outline-dark btn-warning text-decoration-none my-2" style="font-weight: 700">Kembali</a>
                        </div>
                    </div>
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
    <script>
        $('#rw').on('change', function(e) {
            const inp = $('#rt')
            inp.empty();
            inp.prop("disabled", true);
            $.ajax({
                url: "/get_rt",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    rw_id: $('[name="rw"]').val(),
                },
                dataType: 'json',
                success: function(results) {
                    const data = results;
                    inp.append(new Option("-- Pilih RT --", ""));
                    data.forEach(dt => {
                        inp.append(new Option(dt.nomor_rt, dt.id));
                    })
                    inp.prop("disabled", false);
                }
            })
        });
    </script>
@endsection
