<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = [

        'variant_id',
        'variant_name',
        'color',
        'description',

    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
