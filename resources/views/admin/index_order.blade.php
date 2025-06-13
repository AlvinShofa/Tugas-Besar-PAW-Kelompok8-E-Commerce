@extends('layouts.app')

@section('content')
<style>
    table.order-table {
        width: 100%;
        border-collapse: collapse;
    }

    table.order-table th, table.order-table td {
        border: 1px solid #ccc;
        padding: 12px;
        text-align: left;
        vertical-align: middle;
    }

    table.order-table th {
        background-color: #f5f5f5;
        color: #333;
    }

    .btn-view, .btn-confirm {
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
        color: #fff;
        text-decoration: none;
    }

    .btn-view {
        background-color: #6c757d; /* abu-abu */
    }

    .btn-view:hover {
        background-color: #5a6268;
    }

    .btn-confirm {
        background-color: #8B4513; /* coklat */
    }

    .btn-confirm:hover {
        background-color: #5c3317;
    }

    .status-paid {
        color: green;
        font-weight: bold;
    }

    .status-unpaid {
        color: red;
        font-weight: bold;
    }
</style>

<div class="container">
    <h3 class="mb-4">Daftar Order</h3>
    <table class="order-table">
        <thead>
            <tr>
                <th>ID Order</th>
                <th>Nama Pengguna</th>
                <th>Status</th>
                <th>Bukti Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>
                        <a href="{{ route('show_order', $order) }}">
                            {{ $order->id }}
                        </a>
                    </td>
                    <td>{{ $order->user->name }}</td>
                    <td>
                        @if ($order->is_paid)
                            <span class="status-paid">Terkonfirmasi</span>
                        @else
                            <span class="status-unpaid">Pending</span>
                        @endif
                    </td>
                    <td>
                        @if ($order->payment_receipt)
                            <a href="{{ url('storage/' . $order->payment_receipt) }}" target="_blank" class="btn-view">Lihat Bukti</a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if (!$order->is_paid && $order->payment_receipt && Auth::user()->is_admin)
                            <form action="{{ route('admin.confirm_payment', $order) }}" method="post" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn-confirm">Konfirmasi</button>
                            </form>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
