<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'theloai';
    protected $primaryKey = 'id_loai';
    public $timestamps = false;

    protected $fillable = [
        'ten_loai',
        'id_cha',
    ];

    public function parent()
    {
        return $this->belongsTo(self::class, 'id_cha', 'id_loai');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'id_cha', 'id_loai');
    }

    public function books()
    {
        return $this->hasMany(Book::class, 'id_loai', 'id_loai');
    }

    public static function buildPaths(EloquentCollection $categories): array
    {
        $byId = $categories->keyBy('id_loai');
        $paths = [];

        foreach ($categories as $category) {
            $trail = [];
            $current = $category;

            while ($current !== null) {
                array_unshift($trail, trim((string) $current->ten_loai));
                $parentId = $current->id_cha;
                $current = $parentId && $byId->has($parentId) ? $byId->get($parentId) : null;
            }

            $paths[$category->id_loai] = implode(' > ', $trail);
        }

        return $paths;
    }

    public static function descendantIds(EloquentCollection $categories, int $rootId): array
    {
        $groupedByParent = $categories->groupBy('id_cha');
        $queue = [$rootId];
        $result = [];

        while ($queue !== []) {
            $currentId = array_shift($queue);

            if (in_array($currentId, $result, true)) {
                continue;
            }

            $result[] = $currentId;

            foreach ($groupedByParent->get($currentId, collect()) as $child) {
                $queue[] = (int) $child->id_loai;
            }
        }

        return $result;
    }
}