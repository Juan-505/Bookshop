<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q', ''));
        $parentId = $request->integer('parent');
        $childId = $request->integer('child');
        $categories = Category::query()->orderBy('ten_loai')->get();
        if ($childId > 0) {
            $childCategory = $categories->firstWhere('id_loai', $childId);

            if ($childCategory?->id_cha) {
                $parentId = (int) $childCategory->id_cha;
            }
        }
        $categoryPaths = Category::buildPaths($categories);
        $categoryFilterIds = [];
        if ($childId > 0) {
            $categoryFilterIds = [$childId];
        } elseif ($parentId > 0) {
            $categoryFilterIds = Category::descendantIds($categories, $parentId);
        }
        $books = Book::query()
            ->with('category')
            ->search($search)
            ->inCategories($categoryFilterIds)
            ->orderByDesc('ngaynhap')
            ->orderBy('tensach')
            ->paginate(20)
            ->withQueryString();
       return view(
            'products.index',
            compact('books', 'categoryPaths', 'search', 'parentId', 'childId')
        );
    }
    public function show(Book $product): View
    {
        $product->load('category');

        $sameNameProducts = Book::query()
            ->with('category')
            ->whereKeyNot($product->getKey())
            ->similarTitle((string) $product->tensach)
            ->orderByDesc('daban')
            ->orderByDesc('ngaynhap')
            ->limit(8)
            ->get();

        $sameCategoryProducts = Book::query()
            ->with('category')
            ->whereKeyNot($product->getKey())
            ->sameCategory((int) $product->id_loai)
            ->orderByDesc('daban')
            ->orderByDesc('ngaynhap')
            ->limit(8)
            ->get();

        return view('products.show', compact(
            'product',
            'sameNameProducts',
            'sameCategoryProducts'));
    }
}
