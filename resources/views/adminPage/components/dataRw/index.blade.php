@extends('adminPage.layouts.main')
@section('content')
    {{-- @if (session('success'))
        <div class="alert alert-success mb-3 col-lg-10" role="alert">
            {{ session('berhasil') }}
        </div>
    @endif --}}
    <a href="/master/tambah-data-rw" class="btn btn-info mb-4"><i class=" fas fa-solid fa-plus"></i> Tambah
        RW</a>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Rw</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>No.</th>
                            <th>Nomor RW</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($data_rw as $drw)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $drw->nomor_rw }}</td>
                                <td class="text-center">
                                    <a href="/master/list-data-rt/{{ $drw->id }}" class="btn btn-success btn-sm"><i
                                            class="fas fa-solid fa-list"></i></a>
                                    <button class="btn btn-sm btn-danger hapus" data-id="{{ $drw->id }}"><i
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
                title: 'Yakin Menghapus Data RW?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                preConfirm: () => {
                    return $.ajax({
                        url: '/master/hapus-data-rw/' + $(this).data('id'),
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
                                title: 'Data RW Terhapus'
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
