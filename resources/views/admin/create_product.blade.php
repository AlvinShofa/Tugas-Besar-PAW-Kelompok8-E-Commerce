@extends('layouts.app')

@section('content')
<style>
    .btn-brown {
        background-color: #8B4513;
        color: white;
        border: none;
    }

    .btn-brown:hover {
        background-color: #5c3317; /* versi lebih gelap */
        color: white;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Product') }}</div>

                <div class="card-body">
                    <form action="{{ route('admin.store_product') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" placeholder="Name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="description" placeholder="Description" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" name="price" placeholder="Price" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number" name="stock" placeholder="Stock" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-brown mt-3">Submit data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
