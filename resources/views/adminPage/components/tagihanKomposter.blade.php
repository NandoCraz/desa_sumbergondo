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
            <div class="text-center">
                <h6 class="m-0 font-weight-bold text-dark mb-2" style="font-weight: 700;">Seluruh User</h6>
            </div>
            <a href="/tambah-akun" class="btn btn-sm btn-info mt-3">Tambah Akun Keluarga</a>
        </div>
        @include('adminPage.partials.modals.userDetail')
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Tagihan Komposter</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $user->name }}</td>
                                <td>Rp. {{ number_format($user->tagihan_komposter) }}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="/tambah-tagihan-komposter/{{ $user->id }}" class="btn btn-success btn-sm"><i
                                            class="fas fa-solid fa-plus"></i></a>
                                    @if ($user->tagihan_komposter != 0)
                                        <a href="/hapus-tagihan/{{ $user->id }}" class="btn btn-danger btn-sm"><i
                                                class="fas fa-solid fa-trash"></i></a>
                                    @endif
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
