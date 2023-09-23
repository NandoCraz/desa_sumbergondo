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
            <h6 class="m-0 font-weight-bold text-primary">Atur Jadwal Pengangkutan</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="/simpan-jadwal" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="waktu">Tanggal & Jam <span class="fw-bold text-danger">*</span></label>
                    <input class="form-control selector @error('waktu') is-invalid @enderror" id="waktu" type="text"
                        name="waktu" value="{{ isset($jadwal->waktu) ? $jadwal->waktu : '' }}" required autocomplete="off"
                        required>
                    @error('waktu')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4 d-flex flex-column">
                    <label for="desk">Deskripsi</label>
                    <textarea name="desk" id="desk">
                        {{ isset($jadwal->desk) ? $jadwal->desk : '' }}
                    </textarea>
                    @error('desk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-4 mt-5">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $(".selector").flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });
        });
    </script>
@endsection