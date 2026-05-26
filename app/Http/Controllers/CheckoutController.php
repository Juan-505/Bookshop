<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        if (! Auth::check()) {
            return redirect()->route('login.form')->withErrors([
                'email' => 'Bạn cần phải đăng nhập để thanh toán.'
            ]);
        }

        $items = CartItem::query()->with('book')->where('user_id', Auth::id())->get();
        $total = $items->sum(fn (CartItem $item) => ((int) $item->quantity) * ((int) ($item->book?->final_price ?? 0)));

        return view('checkout.index', compact('items', 'total'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'recipient_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'regex:/^[0-9]+$/', 'min:9', 'max:15'],
            'full_address' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:255'],
            'items_json' => ['nullable', 'string'],
        ]);

        if (! Auth::check()) {
            return redirect()->route('login.form')->withErrors([
                'email' => 'Bạn cần phải đăng nhập để thanh toán.'
            ]);
        }

        $items = CartItem::query()->with('book')->where('user_id', Auth::id())->get()->map(function (CartItem $item) {
            return [
                'book' => $item->book,
                'quantity' => (int) $item->quantity,
            ];
        });

        abort_if($items->isEmpty(), 422, 'Giỏ hàng trống.');

        $total = $items->sum(fn (array $item) => ((int) $item['quantity']) * ((int) $item['book']->final_price));

        $order = DB::transaction(function () use ($data, $items, $total) {
            $order = Order::create([
                'user_id' => Auth::id(),
                'recipient_name_snapshot' => $data['recipient_name'],
                'phone_number_snapshot' => $data['phone_number'],
                'full_address_snapshot' => $data['full_address'],
                'order_date' => now(),
                'total_amount' => $total,
                'status' => 'pending',
                'shipping_fee' => 0,
                'discount_amount' => 0,
                'notes' => $data['notes'] ?? null,
            ]);

            foreach ($items as $item) {
                /** @var Book $book */
                $book = $item['book'];
                $quantity = (int) $item['quantity'];
                $unitPrice = (int) $book->final_price;

                OrderItem::create([
                    'order_id' => $order->order_id,
                    'idbook' => $book->idbook,
                    'product_name_snapshot' => $book->tensach,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'subtotal' => $unitPrice * $quantity,
                    'variation_details' => null,
                ]);
            }

            if (Auth::check()) {
                CartItem::query()->where('user_id', Auth::id())->delete();
            }

            return $order;
        });

        return redirect()->route('checkout.success', $order)->with('status', 'Thanh toán thành công. Đơn hàng đã được tạo.');
    }

    public function success(Order $order): View
    {
        $order->load('items.book');

        return view('checkout.success', compact('order'));
    }
}