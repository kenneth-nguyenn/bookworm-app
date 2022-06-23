<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Support\Facades\DB;

class BookRepositories extends BaseRepositories
{
    public function __contruct()
    {
        $this->query = Book::query();
        $this->perPage = 12;
    }

    public function getAllBook()
    {
        return Book::all()->paginate(12);
    }

    public function getBookByID($Id)
    {
        return Book::query()->find($Id);
    }

    public function getReviewBook($Id)
    {
        return Book::query()
            ->join('review',
                'book.id',
                '=',
                'review.book_id')
            ->where('book.id', 'like','%' . $Id . '%')
            ->get();
    }

    public function getSubPrice(){
        return Book::query()
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

    public function getTop10BooksDiscount()
    {
        $subPrice = $this->getSubPrice();

        return Book::query()
            ->joinSub($subPrice, 'sub_price', function($join){
                $join->on('book.id', '=', 'sub_price.book_id');
            })
            ->orderByDesc('sub_price')
            ->limit(10)
            ->get();
    }

    public function getAVGBooks(){
        return Book::query()
            ->fromSub(function ($query){
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

    public function getFinalPrice(){
        return Book::query()
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

    public function getTop8BooksMostRating()
    {
        $finalPrice = $this->getFinalPrice();
        $avgRating = $this->getAVGBooks();

        return Book::query()
            ->joinSub($avgRating, 'avg_rating', function($join){
                $join->on('book.id', '=', 'avg_rating.book_id');
            })
            ->joinSub($finalPrice, 'final_price', function($join){
                $join->on('book.id', '=', 'final_price.id');
            })
            ->orderBy('avg_rating', 'desc')
            ->orderBy('final_price')
            ->select('book.*', 'final_price')
            ->limit(8)
            ->get();
    }

    public function getMostReview(){
        return Book::query()
            ->join('review',
            'review.book_id',
            '=',
            'book.id')
            ->groupBy('review.book_id')
//            ->selectRaw('count(book.id) as most_review, review.book_id');
            ->selectRaw('COALESCE(count(book.id),0) as most_review, review.book_id');

    }

    public function getTop8BooksMostReview()
    {
        $mostReview = $this->getMostReview();
        $finalPrice = $this->getFinalPrice();

        return Book::query()
            ->joinSub($mostReview, 'most_review', function($join){
                $join->on('book.id', '=', 'most_review.book_id');
            })
            ->joinSub($finalPrice, 'final_price', function($join){
                $join->on('book.id', '=', 'final_price.id');
            })
            ->orderBy('most_review', 'desc')
            ->orderBy('final_price')
            ->limit(8)
            ->get();
    }

    public function getSortByOnSale(){
        $subPrice = $this->getSubPrice();
        $finalPrice = $this->getFinalPrice();
        $orderArr = array(
            'sub_price' => 'desc',
            'final_price' => 'asc',
        );

        $query = Book::query()
            ->joinSub($subPrice, 'sub_price', function($join){
                $join->on('book.id', '=', 'sub_price.book_id');
            })
            ->joinSub($finalPrice, 'final_price', function($join){
                $join->on('book.id', '=', 'final_price.id');
            });

        foreach ($orderArr as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        return $query
            ->get();
    }

    public function getSortByPopularity(){
        $mostReview = $this->getMostReview();
        $finalPrice = $this->getFinalPrice();
        $orderArr = array(
            'most_review' => 'desc',
            'final_price' => 'asc',
        );

        $query = Book::query()
            ->joinSub($mostReview, 'most_review', function($join){
                $join->on('book.id', '=', 'most_review.book_id');
            })
            ->joinSub($finalPrice, 'final_price', function($join){
                $join->on('book.id', '=', 'final_price.id');
            });

        foreach ($orderArr as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        return $query
            ->get();
    }

    public function getSortByPrice(bool $isASC=True){
        $finalPrice = $this->getFinalPrice();

        $query = Book::query()
            ->joinSub($finalPrice, 'final_price', function($join){
                $join->on('book.id', '=', 'final_price.id');
            });

        if ($isASC)
            $query->orderBy('final_price', 'asc');
        else $query->orderBy('final_price', 'desc');

        return $query
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

    private function array_get($input, mixed $key)
    {
    }
}
