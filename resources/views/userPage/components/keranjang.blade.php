{{-- @dd($keranjangs) --}}
@extends('userPage.layouts.main')
@section('container')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Perbaiki & Modifikasi</p>
                        <h1>Keranjang</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- cart -->
    <div class="cart-section mt-150 mb-150">
        <div class="container">
            @if (session('error'))
                <div class="alert alert-danger mb-3 col-lg-12" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="cart-table-wrap">
                        <table class="cart-table">
                            <thead class="cart-table-head">
                                <tr class="table-head-row">
                                    <th class="product-remove"></th>
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
                                        <td class="product-remove">
                                            <form action="/keranjang/hapus/{{ $keranjang->id }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"
                                                        aria-hidden="true"></i></button>
                                            </form>
                                        </td>
                                        <td class="product-image"><img
                                                src="{{ asset('storage/' . $keranjang->barang->picture_barang) }}"
                                                alt=""></td>
                                        <td class="product-name">{{ $keranjang->barang->nama_barang }}</td>
                                        <td class="product-price">Rp. {{ number_format($keranjang->barang->harga) }}</td>
                                        <td class="product-quantity">
                                            <form action="/keranjang/update/{{ $keranjang->barang->id }}" method="post">
                                                @csrf
                                                @method('patch')
                                                <input type="number" name="kuantitas" class="kuantitas" id="kuantitas"
                                                    data-id="{{ $keranjang->id }}" value="{{ $keranjang->kuantitas }}">
                                            </form>
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

                <div class="col-lg-4">
                    <div class="total-section">
                        <table class="total-table">
                            <thead class="total-table-head">
                                <tr class="table-total-row">
                                    <th>Total</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="total-data">
                                    <td><strong>Total: </strong></td>
                                    <td>Rp. {{ number_format($total) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        @if ($keranjangs->count() > 0)
                            <div class="cart-buttons">
                                <a href="/checkout" class="boxed-btn black">Check Out</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end cart -->
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
                const url = `/keranjang/${id}/update`;
                $.ajax({
                    url: url,
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': '{{ @csrf_token() }}'
                    },
                    data: {
                        kuantitas: kuantitas,
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            }, 1000));
        });
    </script>
@endsection
