@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah data Siswa</div>

                    <div class="card-body">
                        <button class="btn btn-secondary"><a href="siswa">Kembali</a></button>
                        <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- @method('PUT') --}}
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control mt-2 mb-3" name="nama" id="nama" value="{{ old('nama') }}">
                                {{-- @error('nama')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror --}}
                                <label>Kelas</label>
                                <input type="text" class="form-control mt-2 mb-3" name="kelas" id="kelas" value="{{ old('kelas')}}">
                                {{-- @error('kelas')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror --}}
                            </div>
                            <button type="submit" class="btn btn-primary mb-3">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
