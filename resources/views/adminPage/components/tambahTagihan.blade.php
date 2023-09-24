@extends('adminPage.layouts.main')
@section('content')
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-dark">
                        Tambah Tagihan
                    </h4>
                </div>
                <div class="card-body">

                    <form method="POST" action="/simpan-tagihan">
                        @csrf
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label for="tagihan_insenator">Tagihan</label>
                                <input class="form-control @error('tagihan_insenator') is-invalid @enderror"
                                    id="tagihan_insenator" type="text" name="tagihan_insenator"
                                    value="{{ old('tagihan_insenator') }}" required autocomplete="off">
                                @error('tagihan_insenator')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-3 mb-3 mt-4">
                                <select class="form-select" required name="rw_id" id="rw">
                                    <option value="">-- Pilih RW --</option>
                                    @foreach ($wargas as $warga)
                                        <option value="{{ $warga->id }}">{{ $warga->nomor_rw }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3 mb-3 mt-4">
                                <select class="form-select" required name="rt_id" id="rt">
                                    <option value="">-- Pilih RT --</option>
                                </select>
                            </div>
                        </div>
                        <div class=" text-right mb-3">
                            <button type="submit" class="btn btn-dark btn-outline-info" style="font-weight: 700">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            <a href="/data-pengolahan" class=" btn btn-warning btn-outline-dark text-decoration-none my-2" style="font-weight: 700">Kembali</a>
    <div class="row">
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#rw').on('change', function(e) {
            const inp = $('#rt')
            inp.empty();
            inp.prop("disabled", true);
            $.ajax({
                url: "/get_rt",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    rw_id: $('[name="rw_id"]').val(),
                },
                dataType: 'json',
                success: function(results) {
                    const data = results;
                    inp.append(new Option("-- Pilih RT --", ""));
                    data.forEach(dt => {
                        inp.append(new Option(dt.nomor_rt, dt.id));
                    })
                    inp.prop("disabled", false);
                }
            })
        });
    </script>
@endsection
