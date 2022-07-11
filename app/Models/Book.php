<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'book';

    public function review()
    {
        return $this->hasMany(Review::class, 'book_id', 'id');
    }

    public function discount()
    {
        return $this->hasMany(Discount::class, 'book_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id', 'category_id');
    }

    public function author()
    {
        return $this->belongsTo(Book::class);
    }

    public function scopeFilterBy($query, $request)
    {
        $result = $query;

        if ($request->has('category')) {
            $result = $result->where('category_id', '=', $request->input('category'));
        }

        if ($request->has('author')) {
            $result = $result->where('author_id', '=', $request->input('author'));
        }

//        if ($request->has('rating'))
//            $result = $result->where('rating_start', '>=', $request->input('rating'));

        return $result;
    }

    public function scopeSortBy($query, $request)
    {
        $subPrice = Book::getSubPrice();
        $finalPrice = Book::getFinalPrice();
        $mostReview = Book::getMostReview();

        $result = $query;

        if ($request->has('sortBy')) {
            if ($request->input('sortBy') == 'popularity') {
                return $result
                    ->joinSub($mostReview, 'most_price', function ($join) {
                        $join->on('book.id', '=', 'most_price.book_id');
                    })
                    ->joinSub($finalPrice, 'final_price', function ($join) {
                        $join->on('book.id', '=', 'final_price.id');
                    })
                    ->orderByDesc('most_review')
                    ->orderBy('final_price');
            }
            if ($request->input('sortBy') == 'priceAsc') {
                return $finalPrice->orderBy('final_price');
            }
            if ($request->input('sortBy') == 'priceDesc') {
                return $finalPrice->orderByDesc('final_price');
            }
            return $result
                ->joinSub($subPrice, 'sub_price', function ($join) {
                    $join->on('sub_price.book_id', '=', 'book.id');
                })
                ->joinSub($finalPrice, 'final_price', function ($join) {
                    $join->on('book.id', '=', 'final_price.id');
                })
                ->orderByDesc('sub_price')
                ->orderBy('final_price');
        }
        return $query;
    }

    public function scopeGetBookById($query, $Id)
    {
        return $query->where('id', '=', $Id);
    }

    public function scopeGetBookByAuthor($query, $authorId)
    {
        return $query->where('author_id', '=', $authorId);
    }

    public function scopeGetBookByCategory($query, $categoryId)
    {
        return $query->where('category_id', '=', $categoryId);
    }

    public function scopeGetFinalPrice($query)
    {
        return $query
            ->join('discount',
                'discount.book_id',
                '=',
                'book.id')
            ->where(function ($query) {
                $query->whereDate('discount_end_date', '>=', today())
                    ->orWhereNull('discount_end_date');
            })
            ->whereDate('discount_start_date', '<=', today())
            ->selectRaw('book.*, case
            when discount_price is null
            then book_price
            else discount_price
            end as final_price');
    }

    public function scopeGetSubPrice($query)
    {
        return $query
            ->join('discount',
                'book.id',
                '=',
                'discount.book_id')
            ->where(function ($query) {
                $query->whereDate('discount_end_date', '>=', today())
                    ->orWhereNull('discount_end_date');
            })
            ->whereDate('discount_start_date', '<=', today())
            ->select('*',
                DB::raw('(book_price - discount_price) as sub_price'));
    }

    public function scopeGetAVGBooks($query)
    {
        return $query
            ->fromSub(function ($query) {
                $query->from('review')
                    ->select('review.book_id',
                        DB::raw('round(AVG(rating_start),1) as avg_rating'))
                    ->groupBy('review.book_id');
            }, 'sub')
            ->join('book',
                'sub.book_id',
                '=',
                'id');
    }

    public function scopeGetMostReview($query)
    {
        return $query
            ->join('review',
                'review.book_id',
                '=',
                'book.id')
            ->groupBy('review.book_id')
            ->selectRaw('COALESCE(count(book.id),0) as most_review, review.book_id');
    }

}
