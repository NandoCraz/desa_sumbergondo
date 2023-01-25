{{-- @dd($komentars) --}}
@extends('adminPage.layouts.main')
@section('content')
    @if (session('success'))
        <div class="alert alert-success mb-3 col-lg-10" role="alert">
            {{ session('success') }}
        </div>
    @endif
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
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Komentar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($komentars as $komentar)
                            <tr>
                                <td>{{ $komentar->user->name }}</td>
                                <td>{{ $komentar->user->username }}</td>
                                <td>{{ $komentar->komentar }}</td>
                                <td class="d-flex justify-content-center">
                                    <button class='btn btn-info btn-sm mr-2 viewdetails'>
                                        <i class="fa fa-comments" aria-hidden="true"></i></button>
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
@endsection
