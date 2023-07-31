<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $casts = [
        'created_at' => 'datetime:M d, Y',
    ];

    protected $fillable = [
        'body',
        'slug',
        'title',
        'image',
        'user_id',
        'email_sent',
    ];

    /**
     * Get the creator (user) of the post.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the comments for the blog post.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Scope a query to only include popular users.
     */
    public function scopeSearch(Builder $query, $search = ''): void
    {
        $query->when($search, function ($query, $search) {
            $query->where('title', 'LIKE', "%" . $search . "%")->get();
        });
    }
}
