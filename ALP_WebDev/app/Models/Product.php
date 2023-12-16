<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [

        'product_id',
        'product_name',
        'description',
        'best_seller',
        'price',
        'discount_percent',
        'final_price',

    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->FinalPrice();
        });
        static::updating(function ($model) {
            $model->FinalPrice();
        });
    }

    public function FinalPrice()
    {
        $this->final_price = $this->price - ($this->price * ($this->discount / 100));
    }

    public function variant()
    {
        return $this->hasMany(Variant::class);
    }

    public function image()
    {
        return $this->hasMany(Image::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
