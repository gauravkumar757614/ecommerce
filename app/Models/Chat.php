<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chat extends Model
{
    use HasFactory;

    public function receiverProfile(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id')
            ->select(['id', 'name', 'image']);
    }
}
