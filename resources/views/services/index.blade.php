@extends('layouts.adminlte')

@section('title', 'Layanan Servis')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">Layanan Servis</h3>
        <a href="{{ route('services.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Layanan
        </a>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th style="width: 60px;">#</th>
                    <th>Nama Layanan</th>
                    <th>Harga</th>
                    <th style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($services as $service)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $service->name }}</td>
                        <td>Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('services.edit', $service) }}" class="btn btn-warning btn-xs">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form
                                action="{{ route('services.destroy', $service) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Yakin hapus?');"
                            >
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
                        <td colspan="4" class="text-center">Belum ada layanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
