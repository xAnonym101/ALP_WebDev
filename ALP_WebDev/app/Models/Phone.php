<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_id',
        'phone_number',
        'user_id',
    ];

    public function phone() {
        return $this->belongsTo(User::class);
    }
}
