<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        
        $totalOrders = Order::where('user_id', $user->user_id)->count();
        $completedOrders = Order::where('user_id', $user->user_id)->where('status', 'completed')->count();
        $totalSpent = Order::where('user_id', $user->user_id)->where('status', '!=', 'cancelled')->sum('total_amount');
        $orders = Order::with('items.book')->where('user_id', $user->user_id)->orderBy('order_date', 'desc')->get();

        return view('dashboard', compact('user', 'totalOrders', 'completedOrders', 'totalSpent', 'orders'));
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $user = auth()->user();
        
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->user_id . ',user_id'],
            'phone_number' => ['nullable', 'string', 'max:15'],
            'ngay_sinh' => ['nullable', 'date'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ], [
            'name.required' => 'Họ và tên là bắt buộc.',
            'email.required' => 'Địa chỉ email là bắt buộc.',
            'email.email' => 'Địa chỉ email không đúng định dạng.',
            'email.unique' => 'Email này đã được sử dụng bởi tài khoản khác.',
            'ngay_sinh.date' => 'Ngày sinh không đúng định dạng.',
            'password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
        ]);

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone_number = $data['phone_number'];
        $user->sdt = $data['phone_number'];
        $user->ngay_sinh = $data['ngay_sinh'] ?: null;

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return redirect()->route('dashboard')->with('status', 'Cập nhật thông tin cá nhân thành công.');
    }
}