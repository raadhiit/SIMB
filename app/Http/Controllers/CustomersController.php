<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\customers;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = customers::orderBy('name')->get();

        return view('customer.index', compact('customers'));
    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'phone'        => 'nullable|string|max:30',
            'plate_number' => 'nullable|string|max:20',
        ]);

        customers::create($data);

        return redirect()
            ->route('customer.index')
            ->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function edit(customers $customer)
    {
        return view('customer.edit', compact('customer'));
    }

    public function update(Request $request, customers $customer)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'phone'        => 'nullable|string|max:30',
            'plate_number' => 'nullable|string|max:20',
        ]);

        $customer->update($data);

        return redirect()
            ->route('customer.index')
            ->with('success', 'Pelanggan berhasil diperbarui.');
    }

    public function destroy(customers $customer)
    {
        $customer->delete();

        return redirect()
            ->route('customer.index')
            ->with('success', 'Pelanggan berhasil dihapus.');
    }
}
