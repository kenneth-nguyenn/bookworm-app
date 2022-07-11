<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'author';

    public static function getTableName(): string
    {
        return 'author';
    }

    public function book()
    {
        return $this->hasMany(Category::class, 'id', 'category_id');
    }
}
