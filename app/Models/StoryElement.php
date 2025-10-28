<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoryElement extends Model
{
    protected $fillable = [
        'story_id',
        'type',
        'content',
        'file_path',
        'order',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    /**
     * Get the story that owns the element.
     */
    public function story(): BelongsTo
    {
        return $this->belongsTo(Story::class);
    }
}
