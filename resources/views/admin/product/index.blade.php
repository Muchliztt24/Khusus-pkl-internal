@extends('layouts.admin')
@section('content')
<div class="container">
    <h1>Daftar Product</h1>
    <button class="btn btn-primary"><a href="{{route('admin.product.create')}}">Tambah product</a></button>
    <div class="col-12">
        <!-- 5. card with background -->
        <div class="table-responsive">
            <table class="table">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>No</th>
                        <th>Category name</th>
                        <th>Product Name</th>
                        <th>Slug</th>
                        <td>Photo Product</td>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($product as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->category->nama }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->slug }}</td>
                            <td><img src="{{asset('storage/'.$item->gambar)}}"  width="100" height="40"></td>
                            <td>
                                <button class="btn btn-success"><a href="{{route('admin.product.edit',$item->id)}}">Edit</a></button>
                                <form action="{{route('admin.product.destroy', $item->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>    
                    @empty
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforelse
                    
                </tbody>
            </table>
            </div>       

</div>
@endsection