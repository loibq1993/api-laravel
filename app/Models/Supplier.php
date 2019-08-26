<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';

    protected $fillable = [
        'company_name',
        'short_name',
        'address',
        'phone',
        'fax',
        'website'
    ];
}
