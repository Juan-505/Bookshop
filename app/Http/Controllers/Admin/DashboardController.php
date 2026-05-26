<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'userCount' => User::query()->count(),
            'categoryCount' => Category::query()->count(),
            'productCount' => Book::query()->count(),
            'orderCount' => Order::query()->count(),
            'recentOrders' => Order::query()->with('user')->orderByDesc('order_id')->limit(5)->get(),
        ]);
    }
}