<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserUpload extends Model
{
    protected $fillable = [
        'user_id',
        'story_id',
        'file_name',
        'file_path',
        'file_type',
        'file_size',
        'upload_type',
    ];

    /**
     * Get the user that owns the upload.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the story that owns the upload.
     */
    public function story(): BelongsTo
    {
        return $this->belongsTo(Story::class);
    }
}
