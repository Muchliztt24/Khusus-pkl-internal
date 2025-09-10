@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('orders.my') }}" class="btn btn-primary">
                &laquo; Kembali ke Daftar Pesanan
            </a>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Detail Pesanan #{{ $order->id }}</h4>
                    <span class="badge {{ $order->status == 'completed' ? 'bg-success' : 'bg-primary' }}">
                        {{ $order->status == 'completed' ? 'Selesai' : 'Menunggu Pembayaran' }}
                    </span>
                </div>
                <div class="card-body">
                    <h5>Informasi Pembayaran</h5>
                    <div class="mb-2">
                        <strong>Tanggal Pesanan:</strong>
                        <span>{{ $order->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="mb-2">
                        <strong>Status Pesanan:</strong>
                        <span>{{ $order->status == 'completed' ? 'Selesai' : 'Menunggu Pembayaran' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Produk</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                <th width="100">Photo</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderProduct as $item)
                                    <tr>
                                        <td>
                                            @if($item->product->gambar)
                                                <img src="{{ asset('storage/' . $item->product->gambar) }}" alt="{{ $item->product->nama }}" class="img-fluid" style="max-width: 100px;">
                                            @else
                                            <div class="bg-light text-center" style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center;">
                                                Tidak ada gambar
                                            </div>
                                            @endif
                                        </td>
                                        <td>
                                            <h6 class="mb-0">{{$item->product->nama}}</h6>
                                        </td>
                                        <td>Rp{{ number_format($item->product->harga, 0, ',', '.') }}</td>
                                        <td>
                                            @if($order->status == 'pending')
                                               <form action="{{ route('updateQuantity', $order->id) }}" method="post">
                                                   @csrf
                                                   <input type="hidden" name="product_id" value="{{ $item->product  ->id }}">
                                                   <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stok }}" class="form-control" style="width: 80px; display: inline-block;">
                                                   <button type="submit" class="btn btn-sm btn-primary">Perbarui</button>
                                               </form>
                                               <small class="text-muted d-block mt-1">
                                                   Stok Tersisa: {{ $item->product->stok }}
                                               </small>
                                               @else
                                               <span class="badge bg-secondary">{{ $item->product->stok }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                                            @if($order->status == 'pending')
                                                <form action="{{ route('removeItem') }}" method="post" class="mt-2">
                                                    @csrf
                                                    <input type="hidden" name="order_product_id" value="{{ $item->id }}">
                                                    <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                                                    Hapus</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-end"><strong>Total:</strong></td>
                                    <td class="text-end"><strong>Rp{{ number_format($order->total_harga, 0, ',', '.') }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Ringkasan Pesanan</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Jumlah item
                            <span>{{ $order->orderProduct->sum('quantity') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total Harga
                            <span>Rp{{ number_format($order->total_harga, 0, ',', '.') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Status Pesanan
                            <span class="badge {{ $order->status == 'completed' ? 'bg-success' : 'bg-primary' }}">
                                {{ $order->status == 'completed' ? 'Selesai' : 'Menunggu Pembayaran' }}
                            </span>
                        </li>
                    </ul>

                    @if($order->status == 'pending')
                        <div class="mt-3">
                            <form action="{{ route('checkOut') }}" method="post">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>

            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
