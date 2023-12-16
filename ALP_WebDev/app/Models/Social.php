<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;

    protected $fillable = [

        'social_id',
        'socialmedia_icon',
        'socialmedia_name',
        'socialmedia_link',

    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
