@extends('adminPage.layouts.main')

@section('content')
    <div class="container mb-4">
        <h2 class="fw-bolder" style="font-weight: bold">Master Data</h2>
        <div class="row mt-3">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Kategori
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($kategoris) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-solid fa-pen-nib fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Barang (Seluruh)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($barangs) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-solid fa-pen-nib fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Barang (Tersedia)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($barangSiap) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-solid fa-pen-nib fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Data Montir
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($montirs) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-solid fa-pen-nib fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Pelayanan
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($pelayanans) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-solid fa-pen-nib fa-2x text-gray-300"></i>
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
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Belum Dibayar
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($belumDibayar) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-solid fa-pen-nib fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Menunggu Konfirmasi
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($menungguKonfirmasi) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-solid fa-pen-nib fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Diproses
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($diproses) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-solid fa-pen-nib fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Dikirim
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($dikirim) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-solid fa-pen-nib fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Selesai
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($penjualanSelesai) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-solid fa-pen-nib fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Hasil Penjualan
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.
                                    {{ number_format($hasilPenjualan) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-solid fa-pen-nib fa-2x text-gray-300"></i>
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
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Menunggu Konfirmasi Admin
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($menungguAdmin) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-solid fa-pen-nib fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Penawaran
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($penawaran) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-solid fa-pen-nib fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Pembayaran
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($pembayaran) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-solid fa-pen-nib fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Sedang Dikerjakan
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($dikerjakan) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-solid fa-pen-nib fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Selesai
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($selesai) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-solid fa-pen-nib fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Hasil Layanan
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($hasilBooking) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-solid fa-pen-nib fa-2x text-gray-300"></i>
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
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    User Terdaftar
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($users) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-solid fa-pen-nib fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Ulasan User
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($komentars) }}</div>
                            </div>
                            <div class="col-auto" style="color: rgb(52, 52, 255)">
                                <i class="fas fa-solid fa-pen-nib fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <h2 class="mb-4 text-center" style="font-weight: bold">Total Penjualan Sparepart</h2>
        <canvas id="myChart" class="mb-5" height="100px"></canvas>
        <h2 class="my-4 text-center" style="font-weight: bold">Total Booking Layanan</h2>
        <canvas id="myChartBkn" height="100px"></canvas>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        var labelPesanan = {{ Js::from($labelPesanan) }};
        var labelBooking = {{ Js::from($labelBooking) }};
        var dataPesanan = {{ Js::from($dataPesanan) }};
        var dataBooking = {{ Js::from($dataBooking) }};

        const dataPsn = {
            labels: labelPesanan,
            datasets: [{
                label: 'Total Penjualan Sparepart',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: dataPesanan,
            }]
        };

        const dataBkn = {
            labels: labelBooking,
            datasets: [{
                label: 'Total Booking Layanan',
                backgroundColor: 'rgb(52, 52, 255)',
                borderColor: 'rgb(52, 52, 255)',
                data: dataBooking,
            }]
        };

        const configPesanan = {
            type: 'line',
            data: dataPsn,
            options: {}
        };

        const configBooking = {
            type: 'line',
            data: dataBkn,
            options: {}
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            configPesanan,
        );
        const myChartBkn = new Chart(
            document.getElementById('myChartBkn'),
            configBooking,
        );
    </script>
@endsection
