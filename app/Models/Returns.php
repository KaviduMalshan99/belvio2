<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Returns extends Model
{
    protected $fillable = [
        'product_id',
        'reason',
        'media',
        'status',
        'customer_id',
        'order_item_id',
    ];

    protected $casts = [
        'media' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function customerOrderItem()
{
    return $this->belongsTo(CustomerOrderItems::class, 'order_item_id');
}

}
