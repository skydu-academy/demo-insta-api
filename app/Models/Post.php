<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
    protected $hidden = ['likes', 'user_id', 'user'];
    protected $appends = ['likes_info', 'username'];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isPublished(): bool
    {
        return $this->status === self::STATUS_PUBLISHED;
    }

    public function getLikesAttribute($value): array
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

    public function getLikesInfoAttribute()
    {
        return $this->getLikesInfo(request()->user());
    }

    public function getUsernameAttribute()
    {
        return $this->user->username;
    }
}
