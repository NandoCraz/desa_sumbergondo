@extends('adminPage.layouts.main')

@section('content')
    <div class="container mb-4">
        <h2 class="fw-bolder" style="font-weight: bold">Master Data</h2>
        <div class="row mt-3">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2" style="border-left: 4px solid yellowgreen">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: yellowgreen">
                                    Total Kategori
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($kategoris) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2" style="border-left: 4px solid cyan">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: cyan">
                                    Total Barang (Seluruh)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($barangs) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-cubes fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2" style="border-left: 4px solid green">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: green">
                                    Total Barang (Tersedia)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($barangSiap) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-cube fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2" style="border-left: 4px solid red">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: red">
                                    Data Montir
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($montirs) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-user-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2" style="border-left: 4px solid cadetblue">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: cadetblue">
                                    Total Pelayanan
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($pelayanans) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-wrench fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-4">
        <h2 class="fw-bolder" style="font-weight: bold">Data Penjualan Sparepart</h2>
        <div class="row mt-3">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2" style="border-left: 4px solid coral">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: coral">
                                    Belum Dibayar
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($belumDibayar) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-credit-card fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2" style="border-left: 4px solid crimson">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: crimson">
                                    Menunggu Konfirmasi
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($menungguKonfirmasi) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-exclamation-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2" style="border-left: 4px solid violet">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: violet">
                                    Diproses
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($diproses) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-spinner fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2" style="border-left: 4px solid goldenrod">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: goldenrod">
                                    Dikirim
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($dikirim) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-truck fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2" style="border-left: 4px solid magenta">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: magenta">
                                    Selesai
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($penjualanSelesai) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-check-square fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2" style="border-left: 4px solid mediumseagreen">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: mediumseagreen">
                                    Hasil Penjualan
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.
                                    {{ number_format($hasilPenjualan) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-usd fa-2x text-gray-300" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-4">
        <h2 class="fw-bolder" style="font-weight: bold">Data Booking Layanan</h2>
        <div class="row mt-3">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2" style="border-left: 4px solid orange">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: orange">
                                    Menunggu Konfirmasi Admin
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($menungguAdmin) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-exclamation-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2" style="border-left: 4px solid gray">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: gray">
                                    Penawaran
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($penawaran) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-question-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2" style="border-left: 4px solid indigo">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: indigo">
                                    Pembayaran
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($pembayaran) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-credit-card fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2" style="border-left: 4px solid lawngreen">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: lawngreen">
                                    Sedang Dikerjakan
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($dikerjakan) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-spinner fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2" style="border-left: 4px solid salmon">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: salmon">
                                    Selesai
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($selesai) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-check-square fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2" style="border-left: 4px solid tomato">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: tomato">
                                    Hasil Pelayanan Service
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($hasilBooking) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-jpy fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-4">
        <h2 class="fw-bolder" style="font-weight: bold">Data Lainnya</h2>
        <div class="row mt-3">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2" style="border-left: 4px solid olive">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: olive">
                                    User Terdaftar
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($users) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100 py-2" style="border-left: 4px solid purple">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: purple">
                                    Total Ulasan User
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($komentars) }}</div>
                            </div>
                            <div class="col-auto" style="color: rgb(52, 52, 255)">
                                <i class="fa fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <h2 class="mb-4 text-center" style="font-weight: bold">Total Penjualan Sparepart & Layanan Service</h2>
        <canvas id="myChart" class="mb-5" height="100px"></canvas>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        var labelPesanan = {{ Js::from($labelPesanan) }};
        var labelBooking = {{ Js::from($labelBooking) }};
        var dataPesanan = {{ Js::from($dataPesanan) }};
        var dataBooking = {{ Js::from($dataBooking) }};

        const data = {
            labels: labelPesanan,
            datasets: [{
                    label: 'Total Penjualan Sparepart',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: dataPesanan,
                },
                {
                    label: 'Total Layanan Service',
                    backgroundColor: 'rgb(52, 52, 255)',
                    borderColor: 'rgb(52, 52, 255)',
                    data: dataBooking,
                }
            ]
        };

        const config = {
            type: 'line',
            data: data,
            options: {
                scale: {
                    ticks: {
                        precision: 0
                    }
                }
            }
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config,
        );
    </script>
@endsection
