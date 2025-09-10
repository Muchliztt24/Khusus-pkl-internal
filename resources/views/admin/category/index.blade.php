@extends('layouts.admin')
@section('content')
<div class="container">
    <h1>Daftar Kategori</h1>
    <button class="btn btn-primary"><a href="{{route('admin.category.create')}}">Tambah category</a></button>
    <div class="col-12">
        <!-- 5. card with background -->
        <div class="table-responsive">
            <table class="table">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>No</th>
                        <th>name</th>
                        <th>Slug</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($category as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->slug }}</td>
                            <td>
                                <button class="btn btn-success"><a href="{{route('admin.category.edit',$item->id)}}">Edit</a></button>
                                <form action="{{route('admin.category.destroy', $item->id)}}" method="post">
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
    </div>
@endsection