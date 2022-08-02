<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes()
    {
        return $this->belongsToMany('App\Models\User', 'likes')->withTimestamps();
        // BelongsToManyは多対多。
        // likesテーブルは中間テーブルにあたる。
        // BelongsToMany(関連するモデル名,中間テーブル名)
    }
    public function isLikedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->likes->where('id', $user->id)->count()
            : false;
    }
    public function getCountLikesAttribute(): int
    {
        // アクセサなので実際に呼び出すときは$post->count_likesとなる
        return $this->likes->count();
    }
}
