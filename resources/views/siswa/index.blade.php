@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-15">
                <div class="card">
                    <div class="card-header">Data Obat
                        <a href="{{ route('siswa.create') }}" class="btn btn-outline-primary" style="float: right">Tambah
                            Data</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive">
                            <thead>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @forelse ($data as $item)
                                    <tr>
                                        <td>{{ $item['id'] }}</td>
                                        <td>{{ $item['nama'] }}</td>
                                        <td>{{ $item['kelas'] }}</td>
                                        <td><h5>Belum Tersedia</h5></td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
