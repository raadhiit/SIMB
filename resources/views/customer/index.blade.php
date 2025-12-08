@extends('layouts.adminlte')

@section('title', 'Pelanggan')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">Data Pelanggan</h3>
        <a href="{{ route('customers.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Pelanggan
        </a>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th style="width:60px;">#</th>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>No Polisi</th>
                    <th style="width:120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customers as $customer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->phone ?? '-' }}</td>
                        <td>{{ $customer->plate_number ?? '-' }}</td>
                        <td>
                            <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning btn-xs">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form
                                action="{{ route('customers.destroy', $customer) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Yakin hapus?')"
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
                        <td colspan="5" class="text-center">Belum ada pelanggan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
