<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';
    protected $primaryKey = 'order_item_id';
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'idbook',
        'product_name_snapshot',
        'quantity',
        'unit_price',
        'subtotal',
        'variation_details',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'idbook', 'idbook');
    }
}