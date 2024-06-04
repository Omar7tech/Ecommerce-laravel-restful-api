<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['area' , "user_id" , "street" , "building"];

    public function user(){
        return $this->belongsTo(User::class , "user_id");
    }
}
