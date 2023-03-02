{{-- @dd($checkoutsDel) --}}
@extends('adminPage.layouts.main')
@section('content')
    {{-- @if (session('success'))
        <div class="alert alert-success mb-3 col-lg-10" role="alert">
            {{ session('success') }}
        </div>
    @endif --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Seluruh User</h6>
        </div>
        @include('adminPage.partials.modals.userDetail')
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>No. Handphone</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->no_hp }}</td>
                                <td class="d-flex justify-content-center">
                                    <button class='btn btn-info btn-sm mr-2 viewdetails' data-id='{{ $user->id }}'>
                                        <i class="fa fa-user-circle" aria-hidden="true"></i></button>
                                    <button class="btn btn-sm btn-danger hapus mr-2" data-id="{{ $user->id }}"><i
                                            class="fas fa-solid fa-trash"></i></button>
                                    <a href="/editUser/{{ $user->id }}" class="btn btn-success btn-sm"><i
                                            class="fas fa-solid fa-pen"></i></a>
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
    <script>
        $(document).ready(function() {

            $('#dataTable').on('click', '.viewdetails', function() {
                var userid = $(this).attr('data-id');
                console.log(userid);

                if (userid > 0) {

                    // AJAX request
                    var url = "{{ route('getUserDetail', [':userid']) }}";
                    url = url.replace(':userid', userid);

                    // Empty modal data
                    $('#tbluserinfo tbody').empty();

                    $.ajax({
                        url: url,
                        dataType: 'json',
                        success: function(response) {

                            // Add employee details
                            $('#tbluserinfo tbody').html(response.html);

                            // Display Modal
                            $('#userModal').modal('show');
                        }
                    });
                }
            });

        });

        $('#dataTable').on('click', '.hapus', function() {
            Swal.fire({
                title: 'Yakin Menghapus User?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                preConfirm: () => {
                    return $.ajax({
                        url: '/deleteUser/' + $(this).data('id'),
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
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
                                title: 'User Terhapus'
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
