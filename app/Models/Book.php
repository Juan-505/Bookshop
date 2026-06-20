<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'sach';
    protected $primaryKey = 'idbook';
    public $timestamps = false;

    protected $fillable = [
        'tensach',
        'hinh',
        'id_loai',
        'dongia',
        'hangton',
        'daban',
        'ngaynhap',
        'giamgia',
        'nhacungcap',
        'tacgia',
        'nxb',
        'namxb',
        'trongluong',
        'sotrang',
        'mota',
        'hinhthuc',
    ];

    protected $casts = [
        'ngaynhap' => 'date',
    ];

    protected $appends = [
        'image_url',
        'final_price',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_loai', 'id_loai');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'idbook', 'idbook');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'product_id', 'idbook');
    }

    public function scopeSearch(Builder $query, string $term): Builder
    {
        if ($term === '') {
            return $query;
        }

        return $query->where('tensach', 'like', '%' . $term . '%');
    }

    public function scopeInCategories(Builder $query, array $categoryIds): Builder
    {
        if ($categoryIds === []) {
            return $query;
        }

        return $query->whereIn('id_loai', $categoryIds);
    }

    public function scopeSameCategory(Builder $query, int $categoryId): Builder
    {
        return $query->where('id_loai', $categoryId);
    }

    public function scopeSimilarTitle(Builder $query, string $title): Builder
    {
        $normalized = trim((string) preg_replace('/\s+/u', ' ', mb_strtolower($title)));

        if ($normalized === '') {
            return $query;
        }

        $tokens = array_values(array_filter(preg_split('/\s+/u', $normalized) ?: []));
        $tokens = array_slice($tokens, 0, 3);

        if ($tokens === []) {
            return $query;
        }

        return $query->where(function (Builder $nested) use ($tokens): void {
            foreach ($tokens as $token) {
                $nested->orWhereRaw('LOWER(tensach) like ?', ['%' . $token . '%']);
            }
        });
    }

    public function getFinalPriceAttribute(): int
    {
        $discount = (int) ($this->giamgia ?? 0);

        if ($discount <= 0) {
            return (int) $this->dongia;
        }

        return (int) round(((int) $this->dongia) * (100 - $discount) / 100);
    }

    public function getImageUrlAttribute(): string
    {
        $fileName = trim((string) $this->hinh);

        if ($fileName !== '' && is_file(public_path('img/books/' . $fileName))) {
            return asset('img/books/' . rawurlencode($fileName));
        }

        $fallbackFile = $this->resolveFallbackBookImage();

        return asset('img/books/' . rawurlencode($fallbackFile));
    }

    private function resolveFallbackBookImage(): string
    {
        $fallbackFiles = [
            'kt-bienmoithuthanhtien.png',
            'kt-bimattuduytrieuphu.png',
            'kt-kinhteviahe.png',
            'kt-mbabanghinh.png',
            'kt-motdoiquantri.png',
            'ky-bienmoithuthanhtien2.png',
            'mg-aot13.png',
            'mg-aot34.png',
            'mg-aot4.png',
            'mg-aot9.png',
            'mg-drm1.png',
            'mg-drm2.png',
            'mg-drm3.png',
            'mg-drm5.png',
            'mg-drm6.png',
            'mg-ovl.png',
            'mg-vhll.png',
            'nn-npta.png',
            'nn-npttd.png',
            'nn-thd.png',
            'sgk-nguvan11-1-canhdieu.png',
            'sgk-nguvan11-1-ctst.png',
            'sgk-toan11-1-ctst.png',
            'sgk-toan11-1-kn.png',
            'sgk-toan11-2-ctst.png',
            'sgk-toan11-2-kn.png',
            'tn-cauchuyenrungxanh.png',
            'tn-cotichcuaba.png',
            'tn-letaon.png',
            'tn-phongthu.png',
            'tn-truyencotichcuavuon.png',
            'tn-volttiengviet1.png',
            'tn-volttiengviet2.png',
        ];

        $seed = (int) ($this->idbook ?? 0);
        $index = $seed % count($fallbackFiles);

        return $fallbackFiles[$index];
    }
}