@extends('layouts.app')

@section('content')

<style>
    .btn-theme {
        background-color: #4B382A !important;
        color: white !important;
        border: 1px solid #4B382A !important;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-theme:hover {
        background-color: #2f2118 !important;
        transform: scale(1.03);
    }

    .btn-danger {
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-danger:hover {
        transform: scale(1.03);
    }

    .card-img-top {
        height: 220px;
        object-fit: cover;
        border-bottom: 1px solid #eee;
    }

    .product-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    /* Styling tabel untuk admin */
    table.products-table {
        width: 100%;
        border-collapse: collapse;
    }

    table.products-table th,
    table.products-table td {
        border: 1px solid #ddd;
        padding: 10px;
        vertical-align: middle;
        text-align: center;
    }

    table.products-table th {
        background-color: #A4855C;
        color: white;
    }

    table.products-table img {
        height: 100px;
        object-fit: cover;
        border-radius: 4px;
    }
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header text-white" style="background-color: rgb(164, 133, 92);">
                    {{ __('Products') }}
                    @isset($category)
                        <span class="ms-2" style="font-weight: normal;">Kategori: {{ $category->name }}</span>
                    @endisset
                </div>

                <div class="card-body">
                    @auth
                        @if (Auth::user()->is_admin)
                            {{-- Tabel produk untuk admin --}}
                            <table class="products-table">
                                <thead>
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Nama Produk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td class="d-flex flex-column gap-2 justify-content-center">
                                                <form action="{{ route('show_product', $product) }}" method="get">
                                                    <button type="submit" class="btn btn-theme btn-sm">Lihat Detail</button>
                                                </form>

                                                <form action="{{ route('admin.edit_product', $product) }}" method="get">
                                                    <button type="submit" class="btn btn-theme btn-sm">Edit</button>
                                                </form>

                                                <form action="{{ route('admin.delete_product', $product) }}" method="post" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted py-4">Tidak ada produk yang tersedia untuk kategori ini.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        @else
                            {{-- Tampilkan produk untuk user biasa --}}
                            <div class="row">
                                @forelse ($products as $product)
                                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex">
                                        <div class="card w-100 product-card">
                                            <img class="card-img-top" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">

                                            <div class="card-body text-center d-flex flex-column">
                                                <h6 class="card-title mb-2">{{ $product->name }}</h6>

                                                <form action="{{ route('show_product', $product) }}" method="get" class="mt-auto">
                                                    <button type="submit" class="btn btn-theme btn-sm w-100 mb-2">Lihat Detail</button>
                                                </form>

                                                <form action="{{ route('add_to_cart', $product) }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="amount" value="1">
                                                    <button type="submit" class="btn btn-theme btn-sm w-100">Tambah ke Keranjang</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center py-5">
                                        <p class="text-muted">Tidak ada produk yang tersedia untuk kategori ini.</p>
                                    </div>
                                @endforelse
                            </div>
                        @endif
                    @else
                        {{-- Jika guest (tidak login) --}}
                        <div class="row">
                            @forelse ($products as $product)
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex">
                                    <div class="card w-100 product-card">
                                        <img class="card-img-top" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">

                                        <div class="card-body text-center d-flex flex-column">
                                            <h6 class="card-title mb-2">{{ $product->name }}</h6>

                                            <form action="{{ route('show_product', $product) }}" method="get" class="mt-auto">
                                                <button type="submit" class="btn btn-theme btn-sm w-100 mb-2">Lihat Detail</button>
                                            </form>

                                            <a href="{{ route('login') }}" class="btn btn-theme btn-sm w-100">Login untuk beli</a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center py-5">
                                    <p class="text-muted">Tidak ada produk yang tersedia untuk kategori ini.</p>
                                </div>
                            @endforelse
                        </div>
                    @endauth
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
