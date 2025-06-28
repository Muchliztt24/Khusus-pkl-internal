@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Edit Product</h4>
            <form action="{{route('admin.product.update',$product->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Category</label>
                    <select class="form-select" name="categori_id" id="categori_id" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $item)
                            <option value="{{$item->id}}" {{$product->categori_id == $item->id ? 'selected': ''}}>{{$item->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Product</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter nama produk" value="{{$product->nama}}" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Enter deskripsi produk" value="{{$product->deskripsi}}" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Stok</label>
                    <input type="number" class="form-control" id="stok" name="stok" placeholder="Enter stok produk" value="{{$product->stok}}" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" placeholder="Enter harga produk" value="{{$product->harga}}" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Photo Product</label>
                    <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" placeholder="Masukan Gambar" >
                    <small class="form-text text-muted">
                        Kosongkan jika tidak ingin mengubah gambar. <br>
                    </small>
                    @if($product->gambar)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $product->gambar) }}">
                    </div>
                    @endif
                </div>
                @error('nama')
                {{ $message }}
                @enderror
                <button type="submit" class="btn btn-primary">
                    <i class="ti ti-send fs-4"></i>
                    Submit
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
