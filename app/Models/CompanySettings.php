<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanySettings extends Model
{
    use HasFactory;
    protected $table = 'company_settings';

    protected $fillable = [
        'title', 'address', 'email', 'contact', 'website', 'footer_text', 'logo',
    ];
}
