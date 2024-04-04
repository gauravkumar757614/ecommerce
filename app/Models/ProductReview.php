<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductReview extends Model
{
    use HasFactory;

    // Relation with user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relation with product review gallery
    public function productReviewGalleries(): HasMany
    {
        return $this->hasMany(ProductReviewGallery::class);
    }

    // Relation with product
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
