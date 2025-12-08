@extends('layouts.adminlte')

@section('title', 'Edit Order Servis')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Order Servis</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('orders.update', $order) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Pelanggan</label>
                <select name="customer_id"
                        class="form-control @error('customer_id') is-invalid @enderror">
                    <option value="">-- pilih pelanggan --</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}"
                            {{ old('customer_id', $order->customer_id) == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }} ({{ $customer->plate_number }})
                        </option>
                    @endforeach
                </select>
                @error('customer_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Layanan</label>
                <select name="service_id"
                        class="form-control @error('service_id') is-invalid @enderror">
                    <option value="">-- pilih layanan --</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}"
                            {{ old('service_id', $order->service_id) == $service->id ? 'selected' : '' }}>
                            {{ $service->name }} - Rp {{ number_format($service->price, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
                @error('service_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Tanggal Servis</label>
                <input type="date"
                       name="service_date"
                       class="form-control @error('service_date') is-invalid @enderror"
                       value="{{ old('service_date', $order->service_date) }}">
                @error('service_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status"
                        class="form-control @error('status') is-invalid @enderror">
                    @php
                        $currentStatus = old('status', $order->status);
                    @endphp
                    <option value="pending" {{ $currentStatus === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="done" {{ $currentStatus === 'done' ? 'selected' : '' }}>Done</option>
                </select>
                @error('status')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <a href="{{ route('orders.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
            <button type="submit" class="btn btn-primary btn-sm">Update</button>
        </form>
    </div>
</div>
@endsection
