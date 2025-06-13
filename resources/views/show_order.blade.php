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

    .total-label {
        font-weight: bold;
    }

    .product-img {
        height: 80px;
        width: 80px;
        object-fit: cover;
        border-radius: 0.5rem;
        border: 1px solid #ddd;
    }

    .table th, .table td {
        vertical-align: middle;
    }
</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header" style="background-color: rgb(164, 133, 92); color: white;">
                    Detail Pesanan
                </div>

                @php $total_price = 0; @endphp

                <div class="card-body">
                    <h5 class="card-title mb-1">ID Pesanan: {{ $order->id }}</h5>
                    <h6 class="card-subtitle text-muted">Pelanggan: {{ $order->user->name }}</h6>

                    <p class="mt-2">
                        Status Pembayaran:
                        <span class="badge bg-{{ $order->is_paid ? 'success' : 'warning' }}">
                            {{ $order->is_paid ? 'Terkonfirmasi' : 'Pending' }}
                        </span>
                    </p>

                    <hr>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Gambar</th>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->transactions as $transaction)
                                    @php
                                        $subtotal = $transaction->product->price * $transaction->amount;
                                        $total_price += $subtotal;
                                    @endphp
                                    <tr>
                                        <td>
                                            <img src="{{ asset('storage/' . $transaction->product->image) }}"
                                                alt="{{ $transaction->product->name }}" class="product-img">
                                        </td>
                                        <td>{{ $transaction->product->name }}</td>
                                        <td>{{ $transaction->amount }} pcs</td>
                                        <td>Rp{{ number_format($transaction->product->price, 0, ',', '.') }}</td>
                                        <td>Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" class="text-end total-label">Total</td>
                                    <td class="total-label">Rp{{ number_format($total_price, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    @if (!$order->is_paid && is_null($order->payment_receipt) && !Auth::user()->is_admin)
                        <form action="{{ route('submit_payment_receipt', $order) }}" method="post" enctype="multipart/form-data">
                            @csrf

                            {{-- Alert Error --}}
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger">{{ $error }}</div>
                                @endforeach
                            @endif

                            {{-- Alert Success --}}
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="mb-3">
                                <label class="form-label">Upload Bukti Transfer <span class="text-danger">*</span></label>
                                <input type="file" name="payment_receipt" class="form-control" required>
                            </div>

                            <div class="alert alert-warning mt-2">
                                Bukti transfer wajib diunggah dan tidak boleh kosong.
                            </div>

                            <button type="submit" class="btn btn-theme mt-3">Checkout</button>
                        </form>
                    @elseif ($order->payment_receipt)
                        <div class="alert alert-info mt-3">
                            Bukti transfer telah diunggah.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
