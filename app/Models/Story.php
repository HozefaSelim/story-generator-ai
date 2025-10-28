<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Story extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'theme',
        'style',
        'content',
        'voice_file_path',
        'video_file_path',
        'pdf_file_path',
        'status',
        'settings',
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    /**
     * Get the user that owns the story.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the story elements for the story.
     */
    public function elements(): HasMany
    {
        return $this->hasMany(StoryElement::class)->orderBy('order');
    }

    /**
     * Get the user uploads for the story.
     */
    public function uploads(): HasMany
    {
        return $this->hasMany(UserUpload::class);
    }
}
