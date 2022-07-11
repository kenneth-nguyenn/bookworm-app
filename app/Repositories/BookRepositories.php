<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Http\Request;

class BookRepositories extends BaseRepositories
{
    protected $query;
    protected int $perPage = 10;

    public function __construct()
    {
        $this->query = Book::query();
    }

    public function setPerPage(Request $request)
    {
        if ($request->has('show')) {
            return $this->perPage = $request->input('show');
        }
        return $this->perPage = 10;
    }

    public function getFilterAndSort(Request $request)
    {
        $query = Book::query()
            ->filterBy($request)
            ->sortBy($request);

        // Rating
//        if ($request->has('rating')){
//            $result = $result->where(Review::filterRating($request->input('rating')));
//        }

        return $query
            ->paginate($this->perPage)
            ->withQueryString();
    }

    public function getTop10BooksDiscount()
    {
        $subPrice = Book::getSubPrice();
        return $this->query
            ->joinSub($subPrice, 'sub_price', function ($join) {
                $join->on('book.id', '=', 'sub_price.book_id');
            })
            ->leftJoin('author', 'author.id', '=', 'book.author_id')
            ->orderByDesc('sub_price')
            ->limit(10);
    }

    public function getTop8BooksMostRating()
    {
        $finalPrice = Book::getFinalPrice();
        $avgRating = Book::getAVGBooks();

        return $this->query
            ->joinSub($avgRating, 'avg_rating', function ($join) {
                $join->on('book.id', '=', 'avg_rating.book_id');
            })
            ->joinSub($finalPrice, 'final_price', function ($join) {
                $join->on('book.id', '=', 'final_price.id');
            })
            ->orderBy('avg_rating', 'desc')
            ->orderBy('final_price')
            ->select('book.*', 'final_price')
            ->limit(8);
    }

    public function getTop8BooksMostReview()
    {
        $mostReview = Book::getMostReview();
        $finalPrice = Book::getFinalPrice();

        return $this->query
            ->joinSub($mostReview, 'most_review', function ($join) {
                $join->on('book.id', '=', 'most_review.book_id');
            })
            ->joinSub($finalPrice, 'final_price', function ($join) {
                $join->on('book.id', '=', 'final_price.id');
            })
            ->orderBy('most_review', 'desc')
            ->orderBy('final_price')
            ->limit(8);
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
