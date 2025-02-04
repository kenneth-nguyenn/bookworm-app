<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'category';

    public function book()
    {
        return $this->hasMany(Book::class, 'category_id', 'id');
    }

    public function scopeGetNameCategory($query)
    {
        return $query->select('category_name');
    }
}
