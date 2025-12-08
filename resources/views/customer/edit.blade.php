@extends('layouts.adminlte')

@section('title', 'Edit Pelanggan')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Edit Pelanggan</div>
    </div>

    <div class="card-body">
        <form action="{{ route('customers.update') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $customer->name) }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>No HP</label>
                <input type="text" name="phone"
                       class="form-control @error('phone') is-invalid @enderror"
                       value="{{ old('phone', $customer->phone) }}">
                @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>No Polisi</label>
                <input type="text" name="plate_number"
                       class="form-control @error('plate_number') is-invalid @enderror"
                       value="{{ old('plate_number', $customer->plate_number) }}">
                @error('plate_number')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <a href="{{ route('customers.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
        </form>
    </div>
</div>