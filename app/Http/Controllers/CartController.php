<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $items = collect();
        $total = 0;

        if (Auth::check()) {
            $items = CartItem::query()->with('book.category')->where('user_id', Auth::id())->get();
            $total = $items->sum(fn (CartItem $item) => ((int) $item->quantity) * ((int) ($item->book?->final_price ?? 0)));
        }

        return view('cart.index', compact('items', 'total'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'product_id' => ['required', 'integer', 'exists:sach,idbook'],
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);

        if (! Auth::check()) {
            return back()->with('status', 'Giỏ hàng khách được lưu trên trình duyệt.');
        }

        $quantity = (int) ($data['quantity'] ?? 1);
        $item = CartItem::query()->firstOrNew([
            'user_id' => Auth::id(),
            'product_id' => (int) $data['product_id'],
        ]);

        $item->quantity = ((int) ($item->quantity ?? 0)) + $quantity;
        $item->save();

        return back()->with('status', 'Đã thêm vào giỏ hàng.');
    }

    public function update(Request $request, CartItem $cartItem): RedirectResponse
    {
        $this->authorizeCartItem($cartItem);

        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cartItem->update(['quantity' => (int) $data['quantity']]);

        return back()->with('status', 'Đã cập nhật giỏ hàng.');
    }

    public function destroy(CartItem $cartItem): RedirectResponse
    {
        $this->authorizeCartItem($cartItem);

        $cartItem->delete();

        return back()->with('status', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }

    public function count(): \Illuminate\Http\JsonResponse
    {
        if (! Auth::check()) {
            return response()->json(['count' => 0]);
        }

        return response()->json(['count' => (int) CartItem::query()->where('user_id', Auth::id())->sum('quantity')]);
    }

    private function authorizeCartItem(CartItem $cartItem): void
    {
        abort_unless(Auth::check() && (int) $cartItem->user_id === (int) Auth::id(), 403);
    }
}