{{-- @dd($komentars) --}}
@extends('adminPage.layouts.main')
@section('content')
    {{-- @if (session('success'))
        <div class="alert alert-success mb-3 col-lg-10" role="alert">
            {{ session('success') }}
        </div>
    @endif --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Seluruh Komentar User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Komentar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($komentars as $komentar)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $komentar->user->name }}</td>
                                <td>{{ $komentar->user->username }}</td>
                                <td>{{ Str::of($komentar->komentar)->limit(50) }}</td>
                                <td class="d-flex justify-content-center">
                                    <button class='btn btn-info btn-sm mr-2 viewdetails' data-id='{{ $komentar->id }}'>
                                        <i class="fa fa-comments" aria-hidden="true"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('adminPage.partials.modals.balasanAdmin')
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
        $(document).ready(function() {
            $('#dataTable').on('click', '.viewdetails', function() {
                var komentarid = $(this).attr('data-id');
                // console.log(komentarid);
                // console.log('test');

                if (komentarid > 0) {

                    // AJAX request
                    var url = "{{ route('getKomentarUser', [':komentarid']) }}";
                    url = url.replace(':komentarid', komentarid);

                    // Empty modal data
                    $('#detailKomentar').empty();

                    $.ajax({
                        url: url,
                        dataType: 'json',
                        success: function(response) {
                            // console.log(response);

                            // Add employee details
                            $('#detailKomentarAdmin').html(response.html);

                            // Display Modal
                            $('#komentarAdminModal').modal('show');
                        }
                    });
                }
            });

            $('#btnBalas').on('click', function() {
                $('#balas').toggleClass('d-none');
            });
        });
    </script>
@endsection