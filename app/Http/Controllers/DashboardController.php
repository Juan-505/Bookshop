<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        
        $totalOrders = Order::where('user_id', $user->user_id)->count();
        $completedOrders = Order::where('user_id', $user->user_id)->where('status', 'completed')->count();
        $totalSpent = Order::where('user_id', $user->user_id)->where('status', 'completed')->sum('total_amount');
        $orders = Order::where('user_id', $user->user_id)->orderBy('order_date', 'desc')->get();

        return view('dashboard', compact('user', 'totalOrders', 'completedOrders', 'totalSpent', 'orders'));
    }
}