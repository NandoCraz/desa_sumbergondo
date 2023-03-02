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
                            <div class="card-header">Foto Profile</div>
                            <div class="card-body text-center">
                                <form method="POST" action="/changeDataUser/{{ $user->id }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <!-- Profile picture image-->
                                    @if ($user->picture_profile)
                                        <img class="imgPreview img-profile mb-2"
                                            src="{{ asset('storage/' . $user->picture_profile) }}" width="170">
                                    @else
                                        <img class="imgPreview img-profile mb-2"
                                            src="{{ asset('storage/profilePicture/userDef.png') }}" width="170">
                                    @endif


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
                        <div class="card mb-4">
                            <div class="card-header">User Details</div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="small mb-1" for="nama">Nama</label>
                                    <input class="form-control @error('name') is-invalid @enderror" id="nama"
                                        name="name" type="text" placeholder="Masukkan nama"
                                        value="{{ $user->name }}" required />
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="small mb-1" for="username">Username</label>
                                    <input class="form-control" name="username" id="username" type="text"
                                        value="{{ $user->username }}" />
                                </div>

                                <div class="mb-3">
                                    <label class="small mb-1" for="no_hp">No. Handphone</label>
                                    <input class="form-control" name="no_hp" id="no_hp" type="text"
                                        value="{{ $user->no_hp }}" />
                                </div>

                                <div class="mb-3">
                                    <label class="small mb-1" for="email">Email</label>
                                    <input class="form-control" id="email" type="email" value="{{ $user->email }}"
                                        disabled readonly />
                                </div>

                                <!-- Submit button-->
                                <div class="text-end mt-5">
                                    <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                                </div>
                                </form>

                            </div>
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
@endsection
