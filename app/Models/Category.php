<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'image',
        'active',
    ];

    public function products() {
        return $this->hasMany(Products::class);
    }
}
