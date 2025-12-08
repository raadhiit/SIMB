<?php

namespace App\Http\Controllers;

use App\Models\customers;
use App\Models\ServiceOrder;
use App\Models\services;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_orders'      => ServiceOrder::count(),
            'pending_orders'    => ServiceOrder::where('status', 'pending')->count(),
            'done_orders'       => ServiceOrder::where('status', 'done')->count(),
            'total_customers'   => customers::count(),
            'total_services'    => services::count(),
            'today_orders'      => ServiceOrder::whereDate('service_date', today())->count(),
        ];

        return view('dashboard.index', compact('stats'));
    }
}
