<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'category_id',
        'description',
        'active',
    ];
    public function products(){
        return $this->hasMany(Products::class);
    }
}
