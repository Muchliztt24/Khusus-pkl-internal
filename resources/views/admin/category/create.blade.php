@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Add Category</h4>
            <form action="{{route('admin.category.store')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Category</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter nama category" value="{{old('nama')}}" required>
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
