<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'shipping_address_id',
        'recipient_name_snapshot',
        'phone_number_snapshot',
        'full_address_snapshot',
        'order_date',
        'total_amount',
        'status',
        'shipping_fee',
        'discount_amount',
        'notes',
    ];

    protected $casts = [
        'order_date' => 'datetime',
        'total_amount' => 'decimal:2',
        'shipping_fee' => 'decimal:2',
        'discount_amount' => 'decimal:2',
    ];

    public const STATUSES = [
        'pending',
        'confirmed',
        'shipping',
        'completed',
        'cancelled',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'confirmed' => 'Đã xác nhận',
            'shipping' => 'Đang giao',
            'completed' => 'Hoàn tất',
            'cancelled' => 'Đã hủy',
            default => 'Chờ xử lý',
        };
    }
}