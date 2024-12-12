<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Promocode extends Model
{
    use HasFactory;
    protected $table = 'promo_codes';

    protected $fillable = [
        'name', 'description', 'percentage', 'start_date', 'end_date',
    ];
}
