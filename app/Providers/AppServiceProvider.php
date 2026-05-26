<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\CartItem;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view): void {
            // Use static variables to cache results for the current request
            static $parents = null;
            static $childrenByParent = null;
            static $cartCount = null;
            static $bestSellers = null;

            if ($parents === null) {
                try {
                    $categories = Category::query()->orderBy('ten_loai')->get();
                    $parents = $categories->whereNull('id_cha')->values();
                    $childrenByParent = $categories->whereNotNull('id_cha')->groupBy('id_cha');
                } catch (\Throwable $e) {
                    $parents = collect();
                    $childrenByParent = collect();
                }
            }

            if ($cartCount === null) {
                try {
                    $cartCount = Auth::check() ? (int) CartItem::query()->where('user_id', Auth::id())->sum('quantity') : 0;
                } catch (\Throwable $e) {
                    $cartCount = 0;
                }
            }

            if ($bestSellers === null) {
                try {
                    $bestSellers = Book::query()->orderByDesc('daban')->limit(5)->get();
                } catch (\Throwable $e) {
                    $bestSellers = collect();
                }
            }

            $view->with([
                'parents' => $parents,
                'childrenByParent' => $childrenByParent,
                'cartCount' => $cartCount,
                'bestSellers' => $bestSellers,
            ]);
        });
    }
}
