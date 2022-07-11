<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'review';

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function scopeFilterRating($query, $rating)
    {
        return $query->where('rating_start', '>=', $rating);
    }

    public function scopeGetReviewById($query, $bookId)
    {
        return $query->where('book_id', 'like', '%' . $bookId . '%');
    }

}
