<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    use HasFactory;

    /**
     * Relation between child and parent category models
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relation between child and sub category models
     */
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
