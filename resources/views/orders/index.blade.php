@extends('layouts.adminlte')

@section('title', 'Order Servis')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">Order Servis</h3>
        <a href="{{ route('orders.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Order Baru
        </a>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Plat</th>
                <th>Layanan</th>
                <th>Status</th>
                <th>Total</th>
                <th style="width:120px;">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->service_date }}</td>
                    <td>{{ $order->customer->name ?? '-' }}</td>
                    <td>{{ $order->customer->plate_number ?? '-' }}</td>
                    <td>{{ $order->service->name ?? '-' }}</td>
                    <td>
                        <span class="badge badge-{{ $order->status === 'done' ? 'success' : 'warning' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('orders.edit', $order) }}" class="btn btn-warning btn-xs">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('orders.destroy', $order) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-xs">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Belum ada order.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
