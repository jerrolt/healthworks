<?php

namespace App\Models;

use App\Models\Message;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'secret',
        'filename',
        'extension',
        'expires_at',
    ];

    /**
     * 
     */
    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class);
    }
}
