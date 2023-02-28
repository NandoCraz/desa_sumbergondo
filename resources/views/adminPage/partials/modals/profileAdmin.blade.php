{{-- <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#profileModal">Large</button> --}}
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User Profile</h5>
            </div>
            <div class="modal-body">
                <div class="container-xl px-4 mt-4">
                    <div class="row">
                        <div class="col-xl-4">
                            <!-- Profile picture card-->
                            <div class="card mb-4 mb-xl-0">
                                <div class="card-header">Foto Profile</div>
                                <div class="card-body text-center">
                                    <form method="POST" action="/changeDataUser/{{ auth()->user()->id }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <!-- Profile picture image-->
                                        @if (auth()->user()->picture_profile)
                                            <img class="imgPreviewProfile img-profile mb-2"
                                                src="{{ asset('storage/' . auth()->user()->picture_profile) }}"
                                                width="170">
                                        @else
                                            <img class="imgPreviewProfile img-profile mb-2"
                                                src="{{ asset('storage/profilePicture/userDef.png') }}" width="170">
                                        @endif

                                        <div class="input-group mb-3">
                                            <input class="form-control @error('picture_profile') is-invalid @enderror"
                                                name="picture_profile" type="file" id="imageFileProfile"
                                                onchange="tampilImageProfile()">
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
                                            value="{{ auth()->user()->name }}" required />
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="small mb-1" for="username">Username</label>
                                        <input class="form-control" name="username" id="username" type="text"
                                            value="{{ auth()->user()->username }}" />
                                    </div>

                                    <div class="mb-3">
                                        <label class="small mb-1" for="no_hp">No. Handphone</label>
                                        <input class="form-control" name="no_hp" id="no_hp" type="text"
                                            value="{{ auth()->user()->no_hp }}" />
                                    </div>

                                    <div class="mb-3">
                                        <label class="small mb-1" for="email">Email</label>
                                        <input class="form-control" id="email" type="email"
                                            value="{{ auth()->user()->email }}" disabled readonly />
                                    </div>

                                    <!-- Submit button-->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                <button class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function tampilImageProfile() {
        const image = document.querySelector('#imageFileProfile');
        const imgPreview = document.querySelector('.imgPreviewProfile');

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
