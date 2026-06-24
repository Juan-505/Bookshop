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

        // Calculate total amount for the order (quantity * unit price per item)
        $total = $items->sum(function ($item) {
            return ((int) $item['quantity']) * ((int) ($item['book']?->final_price ?? 0));
        });

        abort_if($items->isEmpty(), 422, 'Giỏ hàng trống.');

        $firstItem = $items->first();
        $firstItemName = $firstItem['book']?->tensach ?? 'Sách';
        $itemsCount = $items->count();
        $nameOrder = $itemsCount > 1 
            ? $firstItemName . ' và ' . ($itemsCount - 1) . ' sản phẩm khác' 
            : $firstItemName;

        try {
            $order = DB::transaction(function () use ($data, $items, $total, $nameOrder) {
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
                    'name_order' => $nameOrder,
                ]);

                foreach ($items as $item) {
                    /** @var Book $book */
                    $book = Book::where('idbook', $item['book']->idbook)->lockForUpdate()->first();
                    $quantity = (int) $item['quantity'];

                    if (!$book || $book->hangton < $quantity) {
                        throw new \Exception("Sản phẩm '{$item['book']->tensach}' đã hết hàng hoặc không đủ số lượng trong kho.");
                    }

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

                    // Update stock and sold counts
                    $book->hangton -= $quantity;
                    $book->daban += $quantity;
                    $book->save();
                }

                if (Auth::check()) {
                    CartItem::query()->where('user_id', Auth::id())->delete();
                }

                return $order;
            });

            return redirect()->route('checkout.success', $order)->with('status', 'Thanh toán thành công. Đơn hàng đã được tạo.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['checkout_error' => $e->getMessage()]);
        }
    }

    public function success(Order $order): View
    {
        $order->load('items.book');

        return view('checkout.success', compact('order'));
    }
}