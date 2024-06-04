<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable =
        [
            "category_id",
            "brand_id",
            "name",
            "price",
            "doscount",
            "is_available",
            "is_trendy",
            "image",
            "amount"
        ];

    public function category()
    {
        return $this->belongsTo(User::class, "category_id");
    }

    public function brand(){
        return $this->belongsTo(User::class , "brand_id");
    }
}
