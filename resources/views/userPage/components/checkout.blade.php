{{-- @dd($keranjangs->subtotal) --}}
@extends('userPage.layouts.main')
@section('container')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Perbaiki & Modifikasi</p>
                        <h1>Check Out Barang</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- check out section -->
    <div class="checkout-section mt-150 mb-150">
        @if (session('berhasil'))
            <div class="container">
                <div class="alert alert-success mb-3 col-lg-12" role="alert">
                    {{ session('berhasil') }}
                </div>
            </div>
        @endif
        <form action="" method="post"></form>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card single-accordion">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Daftar Alamat
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="shipping-address-form">
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#exampleModal">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Tambah Daftar Alamat
                                    </button>
                                    @include('userPage.partials.modal.daftar_alamat')
                                    @if ($daftar_alamats->count() > 0)
                                        <div class="mt-5">
                                            <label for="">Alamat Tujuan</label>
                                            <select class="form-select" name="daftar_alamat_id">
                                                <option>-- Pilih Alamat Tujuan --</option>
                                                @foreach ($daftar_alamats as $daftar_alamat)
                                                    <option value="{{ $daftar_alamat->id }}">
                                                        {{ $daftar_alamat->nama_penerima }} | {{ $daftar_alamat->alamat }},
                                                        {{ $daftar_alamat->kode_pos }},
                                                        {{ $daftar_alamat->provinsi->nama_provinsi }},
                                                        {{ $daftar_alamat->kota->nama_kab_kota }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="checkout-accordion-wrap">
                        <div class="accordion" id="accordionExample">
                            <div class="card single-accordion">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Pengiriman
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="billing-address-form">
                                            <div class="mb-3">
                                                <label for="">Ekspedia</label>
                                                <select class="form-select"" name="courier" id="courier">
                                                    <option selected>-- Pilih Ekspedia --</option>
                                                    <option value="jne">JNE</option>
                                                    <option value="tiki">TIKI</option>
                                                    <option value="pos">POS</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="">Layanan</label>
                                                <select class="form-select" name="layanan" id="layanan">
                                                    <option selected>-- Pilih Layanan --</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="catatan" class="form-label">Catatan :</label>
                                                <textarea class="form-control" id="catatan" name="catatan" rows="3" style="resize: none"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card single-accordion">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            Detail Pesanan
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="card-details">
                                            <table class="cart-table">
                                                <thead class="cart-table-head">
                                                    <tr class="table-head-row">
                                                        <th class="product-image">Picture</th>
                                                        <th class="product-name">Nama Barang</th>
                                                        <th class="product-price">Harga</th>
                                                        <th class="product-quantity">Kuantitas</th>
                                                        <th class="product-total">Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($keranjangs as $keranjang)
                                                        <tr class="table-body-row">
                                                            <td class="product-image"><img
                                                                    src="{{ asset('storage/' . $keranjang->barang->picture_barang) }}"
                                                                    alt=""></td>
                                                            <td class="product-name">
                                                                {{ $keranjang->barang->nama_barang }}
                                                            </td>
                                                            <td class="product-price">Rp.
                                                                {{ number_format($keranjang->barang->harga) }}
                                                            </td>
                                                            <td class="product-quantity text-center">
                                                                {{ $keranjang->kuantitas }}
                                                            </td>
                                                            <td class="product-total">Rp.
                                                                {{ number_format($keranjang->subtotal) }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="order-details-wrap">
                        <table class="order-details">
                            <thead>
                                <tr>
                                    <th>Detail Pesanan</th>
                                    <th>Harga</th>
                                    <th>Kuantitas</th>
                                </tr>
                            </thead>
                            <tbody class="order-details-body">
                                @foreach ($keranjangs as $keranjang)
                                    <tr>
                                        <td>{{ $keranjang->barang->nama_barang }}</td>
                                        <td>Rp. {{ number_format($keranjang->barang->harga) }}</td>
                                        <td>{{ $keranjang->kuantitas }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tbody class="checkout-details" style="background-color: rgb(224, 224, 224)">
                                <tr>
                                    <td>Shipping</td>
                                    <td colspan="2" id="ongkir">0</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td colspan="2">Rp. {{ number_format($total) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="#" class="boxed-btn">Pesan</a>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <!-- end check out section -->

    <script>
        $('#courier').on('change', function(e) {
            const inp = $('#layanan')
            const ongkir = $('#ongkir')
            inp.prop("disabled", true);
            $.ajax({
                url: "/checkout/cek_ongkir",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    daftar_alamat_id: $('[name="daftar_alamat_id"]').val(),
                    courier: $('[name="courier"]').val(),
                },
                dataType: 'json',
                success: function({
                    results
                }) {
                    const data = results[0];
                    inp.empty()
                    inp.append(new Option('-- Pilih Layanan --', ''))
                    data.costs.forEach(cost => inp.append(new Option(cost.description, cost.service)))
                    inp.prop("disabled", false);
                }
            })
        });
    </script>
@endsection
