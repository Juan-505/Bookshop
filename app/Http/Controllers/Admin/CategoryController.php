<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()->orderBy('id_cha')->orderBy('ten_loai')->get();

        return view('admin.categories.index', [
            'categories' => $categories,
            'paths' => Category::buildPaths($categories),
        ]);
    }

    public function create(): View
    {
        return view('admin.categories.create', [
            'parents' => Category::query()->whereNull('id_cha')->orderBy('ten_loai')->get(),
        ]);
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());

        return redirect()->route('admin.categories.index')->with('status', 'Đã tạo danh mục.');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', [
            'category' => $category,
            'parents' => Category::query()->whereNull('id_cha')->where('id_loai', '!=', $category->id_loai)->orderBy('ten_loai')->get(),
        ]);
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());

        return redirect()->route('admin.categories.index')->with('status', 'Đã cập nhật danh mục.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->children()->exists()) {
            return back()->withErrors(['delete' => 'Danh mục này đang có danh mục con.']);
        }

        if ($category->books()->exists()) {
            return back()->withErrors(['delete' => 'Danh mục này đang có sản phẩm.']);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('status', 'Đã xóa danh mục.');
    }
}