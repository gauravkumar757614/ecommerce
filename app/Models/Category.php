<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Hasmany relation with sub category model
     */
    public function subCategories(){
        return $this->hasMany(SubCategory::class);
    }
}
