{{-- @dd($alamats) --}}
@extends('userPage.layouts.main')
@section('container')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Perbaiki & Modifikasi</p>
                        <h1>Pengaturan</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->
    <!-- products -->
    <div class="product-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="container-xl px-4 mt-4">
                    <h3 class="text-center">Ganti Password</h3>
                    <div class="row mb-5 justify-content-center">
                        <div class="col-lg-8">
                            <!-- Account details card-->
                            <div class="card mb-4">
                                <div class="card-header">User Password</div>
                                <div class="card-body">
                                    <form method="POST" action="/changePassword/{{ auth()->user()->id }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="small mb-1" for="old_pass">Password Lama</label>
                                            <input class="form-control @error('old_pass') is-invalid @enderror"
                                                id="old_pass" name="old_pass" type="password">
                                            @error('old_pass')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="small mb-1" for="new_pass">Password Baru</label>
                                            <input class="form-control @error('new_pass') is-invalid @enderror"
                                                id="new_pass" name="new_pass" type="password" />
                                            @error('new_pass')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="small mb-1" for="konf_pass">Konfirmasi Password Baru</label>
                                            <input class="form-control @error('konf_pass') is-invalid @enderror"
                                                id="konf_pass" name="konf_pass" type="password" />
                                            @error('konf_pass')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <!-- Submit button-->
                                        <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row justify-content-center">
                        <h3 class="mt-5 text-center">Daftar Alamat Pembelian</h3>
                        <div class="col-lg-12">
                            <div class="table-responsive mt-3">
                                <table class="table table-bordered" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Penerima</th>
                                            <th scope="col">No. Hp</th>
                                            <th scope="col">Alamat</th>
                                            <th scope="col">Kota/Kabupaten</th>
                                            <th scope="col">Kode Pos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($alamats->count() > 0)
                                            @foreach ($alamats as $alamat)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $alamat->nama_penerima }}</td>
                                                    <td>{{ $alamat->no_hp }}</td>
                                                    <td>{{ $alamat->alamat }}</td>
                                                    <td>{{ $alamat->kota->nama_kab_kota }},
                                                        {{ $alamat->provinsi->nama_provinsi }}</td>
                                                    <td>{{ $alamat->kode_pos }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7" class="text-center">Belum ada alamat terdaftar..</td>
                                            </tr>
                                        @endif
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end products -->

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
        $('#dataTable').on('click', '.hapus', function() {
            Swal.fire({
                title: 'Yakin Menghapus Alamat?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                preConfirm: () => {
                    return $.ajax({
                        url: '/daftar-alamat/' + $(this).data('id'),
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            _method: 'DELETE'
                        },
                        success: function(data) {
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
                                title: 'Alamat Terhapus'
                            }).then((result) => {
                                location.reload();
                            })
                        }
                    })
                }
            })
        })
    </script>
@endsection
