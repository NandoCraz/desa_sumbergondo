{{-- @dd($pelatihan->pelayanan) --}}
@extends('userPage.layouts.main')
@section('container')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>#LikeSumberGondo</p>
                        <h1>Detail Pelatihan</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->
    <!-- products -->
    <div class="product-section mt-150 mb-150">
        {{-- @if (session('success'))
            <div class="container">
                <div class="alert alert-success mb-3 col-lg-12" role="alert">
                    {{ session('success') }}
                </div>
            </div>
        @endif --}}
        <div class="container">
            <div class="card">
                <div class="card-title">
                    <h3 class="text-center mt-2">Rincian Pelatihan</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5>
                                        Status :
                                        @if ($pelatihan->tipe_bayar == 'website')
                                            @if ($pelatihan->payment_status == '1')
                                                <td>
                                                    <h5><span class="badge" style="background-color: purple">Belum
                                                            Dibayar</span></h5>
                                                </td>
                                            @elseif($pelatihan->payment_status == '2')
                                                <td>
                                                    <h5><span class="badge bg-success">Sudah Dibayar</span></h5>
                                                </td>
                                            @else
                                                <td>
                                                    <h5><span class="badge bg-danger">Kadaluarsa</span></h5>
                                                </td>
                                            @endif
                                        @elseif($pelatihan->tipe_bayar == 'ditempat')
                                            @if ($pelatihan->status == 'Menunggu Konfirmasi')
                                                <td>
                                                    <h5><span class="badge bg-warning">Menunggu Konfirmasi</span></h5>
                                                </td>
                                            @elseif($pelatihan->status == 'Dikonfirmasi')
                                                <td>
                                                    <h5><span class="badge" style="background-color: purple">Belum
                                                            Dibayar</span></h5>
                                                </td>
                                            @elseif($pelatihan->status == 'Sudah Dibayar')
                                                <td>
                                                    <h5><span class="badge bg-success">Sudah Dibayar</span></h5>
                                                </td>
                                            @endif
                                        @endif
                                    </h5>
                                    <h5>Nama Pemesan : <p>{{ $pelatihan->nama_pemesan }}</p>
                                    </h5>
                                    <h5>No. Telepon : <p>{{ $pelatihan->no_telp }}</p>
                                    </h5>
                                    <h5>Waktu (Tanggal & Jam) : <p>{{ $pelatihan->waktu }}</p>
                                    </h5>
                                    <h5>Tipe Pembayaran : <p>
                                            {{ $pelatihan->tipe_bayar == 'website' ? 'Melalui Website' : 'Ditempat' }}</p>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-6">
                            @if ($pelatihan->tipe_bayar != 'ditempat' && $pelatihan->payment_status == '1')
                                <button class="btn btn-lg btn-warning text-light mt-4" id="bayar">Bayar</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end products -->
@endsection

@section('script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

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


    @if ($pelatihan->snap_token != null && $pelatihan->payment_status == '1')
        <script>
            $('#bayar').on('click', function(e) {
                e.preventDefault();
                snap.pay('{{ $pelatihan->snap_token }}', {
                    onSuccess: function(result) {
                        console.log(result);
                        window.location.href = '/layanans'
                    }
                });
            })
        </script>
    @elseif($pelatihan->snap_token == null && $pelatihan->payment_status == '1')
        <script>
            $('#bayar').on('click', function(e) {
                const pesan = $('.pesan');
                e.preventDefault();
                $.ajax({
                    url: "{{ route('pelatihan.charger') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        id: "{{ $pelatihan->id }}",
                    },
                    success: function(response) {
                        snap.pay(response.snap_token, {
                            onSuccess: function(result) {
                                console.log(result);
                                window.location.href = '/pelatihans'
                            }
                        })
                    }
                })
            })
        </script>
    @endif

    <script>
        function debounce(func, timeout = 1000) {
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    func.apply(this, args);
                }, timeout);
            };
        }

        document.querySelectorAll('.kuantitas').forEach(item => {
            item.addEventListener('input', debounce(function() {
                const id = item.dataset.id;
                const kuantitas = item.value;
                const idBooking = $('input[name="id"]').val();
                const url = `/layananBarang/${id}`;
                $.ajax({
                    url: url,
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{ @csrf_token() }}'
                    },
                    data: {
                        kuantitas: kuantitas,
                        id: idBooking
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            }, 1000));
        });
    </script>
@endsection
