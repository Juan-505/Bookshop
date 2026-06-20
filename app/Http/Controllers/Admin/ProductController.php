<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Book::query()->with('category')->orderByDesc('idbook')->get();

        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        return view('admin.products.create', [
            'categories' => Category::query()->orderBy('ten_loai')->get(),
        ]);
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        Book::create($request->validated());

        return redirect()->route('admin.products.index')->with('status', 'Đã tạo sản phẩm.');
    }

    public function edit(Book $product): View
    {
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Category::query()->orderBy('ten_loai')->get(),
        ]);
    }

    public function update(ProductRequest $request, Book $product): RedirectResponse
    {
        $product->update($request->validated());

        return redirect()->route('admin.products.index')->with('status', 'Đã cập nhật sản phẩm.');
    }

    public function destroy(Book $product): RedirectResponse
    {
        if ($product->orderItems()->exists()) {
            return back()->withErrors(['delete' => 'Sản phẩm này đã phát sinh đơn hàng nên không thể xóa.']);
        }

        DB::transaction(function () use ($product): void {
            $product->cartItems()->delete();
            $product->delete();
        });

        return redirect()->route('admin.products.index')->with('status', 'Đã xóa sản phẩm.');
    }
}