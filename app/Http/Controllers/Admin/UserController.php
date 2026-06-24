<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Http\Requests\Admin\UpdateUserRoleRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::query()->orderByDesc('user_id')->paginate(50);

        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        User::create($request->validatedUserData());

        return redirect()->route('admin.users.index')->with('status', 'Đã tạo user mới.');
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $user->fill($request->validatedUserData());

        $user->save();

        return redirect()->route('admin.users.index')->with('status', 'Đã cập nhật user.');
    }

    public function updateRole(UpdateUserRoleRequest $request, User $user): RedirectResponse
    {
        $user->update($request->validatedRoleData());

        return back()->with('status', 'Đã đổi role.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ((int) auth()->id() === (int) $user->getKey()) {
            return back()->withErrors(['delete' => 'Bạn không thể tự xóa chính mình.']);
        }

        try {
            $user->delete();
        } catch (\Exception $e) {
            return back()->withErrors(['delete' => 'Không thể xóa người dùng này vì họ đã có đơn hàng hoặc dữ liệu liên kết khác.']);
        }

        return redirect()->route('admin.users.index')->with('status', 'Đã xóa user.');
    }
}