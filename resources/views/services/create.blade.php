@extends('layouts.adminlte')

@section('title', 'Tambah Layanan')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah Layanan</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('services.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama Layanan</label>
                <input
                    type="text"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}"
                >
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label>Harga</label>
                <input
                    type="number"
                    name="price"
                    class="form-control @error('price') is-invalid @enderror"
                    value="{{ old('price') }}"
                >
                @error('price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <a href="{{ route('services.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
        </form>
    </div>
</div>
@endsection
