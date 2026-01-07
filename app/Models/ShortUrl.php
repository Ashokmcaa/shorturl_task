<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    protected $fillable = ['code', 'original_url', 'user_id'];




    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
