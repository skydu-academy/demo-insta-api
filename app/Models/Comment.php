<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = ['user_id','user'];
    protected $with = ['user'];
    protected $appends = ['username', 'user_image_url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUsernameAttribute()
    {
        return $this->user->username;
    }

    public function getUserImageUrlAttribute()
    {
        return $this->user->image_url;
    }
}
