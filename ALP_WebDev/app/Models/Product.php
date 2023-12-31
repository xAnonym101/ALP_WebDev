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
        'category_id',
        'event_id',
        'link'

    ];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($model) {
    //         $model->FinalPrice();
    //     });
    //     static::updating(function ($model) {
    //         $model->FinalPrice();
    //     });
    // }

    // public function FinalPrice()
    // {
    //     $this->final_price = $this->price - ($this->price * ($this->discount_percent / 100));
    // }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function images()
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
