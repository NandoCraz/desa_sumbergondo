@extends('adminPage.layouts.main')
@section('content')
    {{-- @if (session('berhasil'))
        <div class="alert alert-success mb-3 col-lg-10" role="alert">
            {{ session('berhasil') }}
        </div>
    @endif --}}
    <a href="/master/data-barang/create" class="btn btn-info mb-4"><i class=" fas fa-solid fa-plus"></i> Tambah Barang</a>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
        </div>
        <div class="card-body">
            <div class="row mb-5">
                <form action="/barang/laporan" method="get" class="col-lg-6">
                    @csrf
                    <label for="timestamp" class="mb-4">Pilih Tanggal Untuk Cetak PDF</label>
                    <div class="d-flex">
                        <div class="mr-3">
                            <input class="form-control selector" type="text" id="timestamp" name="timestamp"
                                autocomplete="off" required>
                        </div>
                        <button type="submit" class="btn btn-success btn-sm">Cetak</button>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Berat (Gram)</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($barangs as $barang)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $barang->nama_barang }}</td>
                                <td class="text-center">{{ $barang->berat }}</td>
                                <td class="text-center">{{ $barang->harga }}</td>
                                <td class="text-center">{{ $barang->stok }}</td>
                                <td class="text-center">
                                    @foreach ($barang->kategori as $kategori)
                                        <ul class="list-group">
                                            <li class="list-group-item">{{ $kategori->nama_kategori }}</li>
                                        </ul>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <a href="/master/data-barang/{{ $barang->id }}/edit" class="btn btn-success btn-sm"><i
                                            class="fas fa-solid fa-pen"></i></a>
                                    <button class="btn btn-sm btn-danger hapus" data-id="{{ $barang->id }}"><i
                                            class="fas fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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
    <script>
        $('#dataTable').on('click', '.hapus', function() {
            Swal.fire({
                title: 'Yakin Menghapus Barang?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                preConfirm: () => {
                    return $.ajax({
                        url: '/master/data-barang/' + $(this).data('id'),
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
                                title: 'Barang Terhapus'
                            }).then((result) => {
                                location.reload();
                            })
                        }
                    })
                }
            })
        })
    </script>
    <script>
        $(document).ready(function() {
            $(".selector").flatpickr({
                mode: "range",
                dateFormat: "Y-m-d",
            });
        });
    </script>
@endsection
