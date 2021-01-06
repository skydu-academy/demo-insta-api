<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed user_id
 */
class Post extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_PUBLISHED = 'published';

    protected $guarded = [];
    protected $hidden = ['likes'];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function isPublished()
    {
        return $this->status === self::STATUS_PUBLISHED;
    }

    public function getLikesAttribute($value)
    {
        return json_decode($value) ?: [];
    }

    public function getLikesInfo(?User $user)
    {
        $count = count($this->likes);
        $is_liked = $user ? in_array($user->id, $this->likes) : false;

        return compact('count', 'is_liked');
    }

    public function userLikeIndex(User $user)
    {
        return array_search($user->id, $this->likes);
    }

}
