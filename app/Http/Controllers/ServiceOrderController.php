<?php

namespace App\Http\Controllers;

use App\Models\ServiceOrder;
use App\Models\customers;
use App\Models\services;
use Illuminate\Http\Request;

class ServiceOrderController extends Controller
{
    public function index()
    {
        $orders = ServiceOrder::with(['customer', 'service'])
            ->orderByDesc('service_date')
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = customers::orderBy('name')->get();
        $services  = services::orderBy('name')->get();

        return view('orders.create', compact('customers', 'services'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id'  => 'required|exists:customers,id',
            'service_id'   => 'required|exists:services,id',
            'service_date' => 'required|date',
            'status'       => 'required|in:pending,done',
        ]);

        // total pakai harga service
        $service = services::findOrFail($data['service_id']);
        $data['total'] = $service->price;

        ServiceOrder::create($data);

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order servis berhasil dibuat.');
    }

    public function edit(ServiceOrder $order)
    {
        $customers = customers::orderBy('name')->get();
        $services  = services::orderBy('name')->get();

        return view('orders.edit', compact('order', 'customers', 'services'));
    }

    public function update(Request $request, ServiceOrder $order)
    {
        $data = $request->validate([
            'customer_id'  => 'required|exists:customers,id',
            'service_id'   => 'required|exists:services,id',
            'service_date' => 'required|date',
            'status'       => 'required|in:pending,done',
        ]);

        $service = services::findOrFail($data['service_id']);
        $data['total'] = $service->price;

        $order->update($data);

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order servis berhasil diperbarui.');
    }

    public function destroy(ServiceOrder $order)
    {
        $order->delete();

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order servis berhasil dihapus.');
    }
}
