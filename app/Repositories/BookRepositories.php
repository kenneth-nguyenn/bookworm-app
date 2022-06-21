<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Discount;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class BookRepositories extends BaseRepositories
{
    public function __contruct(){
        $this->query = Book::query();
    }

    public function getAllBook(){
        return Book::all();
    }

    public function getBookByID($Id){
        return Book::query()->find($Id);
    }

    public function getReviewBook($Id)
    {
        return Book::query()
            ->join('review',
                'book.id',
                '=',
                'review.book_id')
            ->get();
    }

    public function getTop10BooksDiscount(){
        return Book::query()
            ->join('discount',
                'book.id',
                '=',
                'discount.book_id')
            ->where( function ($query)
            {
                $query->whereDate('discount_end_date', '>=', today())
                    ->orWhereNull('discount_end_date');
            })
            ->whereDate('discount_start_date', '<=', today())
            ->select('*',
                DB::raw('(book_price - discount_price) as sub_price'))
            ->orderByDesc('sub_price')
            ->limit(10)
            ->get();
    }

    public function getTop8BooksMostRating(){
        return Book::query()
            ->join('review',
                'review.book_id',
                '=',
                'book.id')
            ->select('review.book_id',
                DB::raw('round(AVG(rating_start),1) as avg_rating'))
            ->groupBy('review.book_id')
            ->orderByDesc('avg_rating')
//            ->join(
//                'book',
//                'book.id',
//                '=',
//                'review.book_id'
//            )
//            ->orderBy('book.price')
            ->limit(8)
            ->get();
    }

    public function getById($Id, $conditions)
    {
        // TODO: Implement getById() method.
    }

    public function filter($conditions)
    {
        // TODO: Implement filter() method.
    }

    public function create($data)
    {
        // TODO: Implement create() method.
    }

    public function update($data)
    {
        // TODO: Implement update() method.
    }
}
