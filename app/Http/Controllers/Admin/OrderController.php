<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderStatusRequest;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::query()->with('user')->orderByDesc('order_id')->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        $order->load(['user', 'items.book']);

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(OrderStatusRequest $request, Order $order): RedirectResponse
    {
        $order->update($request->validated());

        return back()->with('status', 'Đã cập nhật trạng thái đơn hàng.');
    }
}