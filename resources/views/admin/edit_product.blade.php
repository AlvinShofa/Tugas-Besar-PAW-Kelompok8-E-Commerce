@extends('layouts.app')

@section('content')
<style>
    .btn-brown {
        background-color: #8B4513;
        color: #fff;
        border: none;
    }

    .btn-brown:hover {
        background-color: #5c3317;
        color: #fff;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .card-header {
        background-color: #f5f5f5;
        font-weight: bold;
        color: #333;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">{{ __('Update Product') }}</div>

                <div class="card-body">
                    <form action="{{ route('admin.update_product', $product) }}" method="post" enctype="multipart/form-data">
                        @method('patch')
                        @csrf

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" placeholder="Name" class="form-control"
                                value="{{ $product->name }}">
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="description" placeholder="Description" class="form-control"
                                value="{{ $product->description }}">
                        </div>

                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="price" placeholder="Price" class="form-control"
                                value="{{ $product->price }}">
                        </div>

                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number" name="stock" placeholder="Stock" class="form-control"
                                value="{{ $product->stock }}">
                        </div>

                        <div class="form-group">
                            <label>Category</label>
                            <select name="category" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-brown mt-3">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
