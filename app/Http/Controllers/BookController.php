<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Repositories\BookRepositories;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    protected BookRepositories $bookRepositories;
    protected $query;

    public function __construct(BookRepositories $bookRepositories)
    {
        $this->bookRepositories = $bookRepositories;
        $this->query = Book::query();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        //http://localhost:8000/books?category=ABC&author=1&rating=1&sortBy=onsale&show=20
        $result = $this->query;

        // Set perPage
        if ($request->has('show')) {
            $this->bookRepositories->setPerPage($request);
        }

        // Recommend
        if ($request->has('recommend')) {
            return response($this->bookRepositories
                ->getTop8BooksMostRating()
                ->get());
//            return response(Book::getFinalPrice()->get());
        }

        if ($request->has('onsales')) {
//            return response($this->bookRepositories
//                ->getTop8BooksMostRating()
//                ->get());
            return response($this->bookRepositories->getTop10BooksDiscount()->get());
        }

        // Popular
        if ($request->has('popular')) {
            return response($this->bookRepositories
                ->getTop8BooksMostReview()
                ->get());
//            return response($this->bookRepositories->getMostReview()->getFinalPrice()->limit(8)->get());
        }

        // Filter & Sort
        $result = $this->bookRepositories->getFilterAndSort($request);
        return response($result);
    }

    // List Book
    public function listBook($Id)
    {
        $result = Book::getBookById($Id);

        if (request()->filled('review')) {
            $result->Review::getReviewById($Id);
        }

        return response($result->get());
//            ->paginate($this->perPage)->withQueryString());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @return Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Book $book
     * @return Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Book $book
     * @return Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
