@extends('layouts.app')

<style>
    .btn-theme {
        background-color: #4B382A !important;
        color: white !important;
        border: 1px solid #4B382A !important;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-theme:hover {
        background-color: #2f2118 !important;
        color: white !important;
        transform: scale(1.03);
    }

    .table th,
    .table td {
        vertical-align: middle !important;
    }

    .table img {
        height: 100px;
        object-fit: cover;
    }

    .total-label {
        font-weight: bold;
    }
</style>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header" style="background-color: rgb(164, 133, 92); color: white;">
                        {{ __('Cart') }}
                    </div>

                    <div class="card-body">
                        {{-- Tampilkan error --}}
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                        @endif

                        {{-- Pesan jika user dinonaktifkan --}}
                        @if (!auth()->user()->status)
                            <div class="alert alert-warning">
                                Akun Anda <strong>dinonaktifkan</strong>. Anda tidak dapat melakukan pembelian.
                                Hanya bisa menambah ke keranjang dan melihat produk.
                            </div>
                        @endif

                        @php $total_price = 0; @endphp

                        @if($carts->isEmpty())
                            <p class="text-center">Your cart is empty.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Image</th>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Subtotal</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carts as $cart)
                                            <tr>
                                                <td>
                                                    <img src="{{ url('storage/' . $cart->product->image) }}" alt="Product Image">
                                                </td>
                                                <td>{{ $cart->product->name }}</td>
                                                <td style="width: 160px;">
                                                    <form action="{{ route('update_cart', $cart) }}" method="post" class="d-flex">
                                                        @method('patch')
                                                        @csrf
                                                        <input type="number" class="form-control me-2" name="amount"
                                                            value="{{ $cart->amount }}" min="1">
                                                        <button type="submit" class="btn btn-theme btn-sm">Update</button>
                                                    </form>
                                                </td>
                                                <td>Rp{{ number_format($cart->product->price, 0, ',', '.') }}</td>
                                                <td>
                                                    Rp{{ number_format($cart->product->price * $cart->amount, 0, ',', '.') }}
                                                </td>
                                                <td>
                                                    <form action="{{ route('delete_cart', $cart) }}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @php
                                                $total_price += $cart->product->price * $cart->amount;
                                            @endphp
                                        @endforeach
                                        <tr>
                                            <td colspan="4" class="text-end total-label">Total</td>
                                            <td colspan="2" class="total-label">
                                                Rp{{ number_format($total_price, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-end">
                                <form action="{{ route('checkout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-theme"
                                        @if (!auth()->user()->status) disabled @endif>
                                        Checkout
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
