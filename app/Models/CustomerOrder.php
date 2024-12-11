<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    use HasFactory;


    protected $table = 'customer_orders';

    protected $fillable = [
        'order_code',
        'user_id',
        'customer_name',
        'phone',
        'email',
        'house_no',
        'apartment',
        'city',
        'postal_code',
        'date',
        'total_cost',
        'status',
        'payment_method',
        'payment_status',
    ];

    public function items()
    {
        return $this->hasMany(CustomerOrderItems::class, 'order_code', 'order_code');
    }
}
