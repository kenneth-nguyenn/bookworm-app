<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Repositories\BookRepositories;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    protected BookRepositories $bookRepositories;

    public function __construct(BookRepositories $bookRepositories)
    {
        $this->bookRepositories = $bookRepositories;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->has('recommend')){
            return response($this->bookRepositories->getTop8BooksMostRating());
        }
        elseif ($request->has('popular')){
            return response($this->bookRepositories->getTop8BooksMostReview());
        }
        elseif ($request->has('id') && (bool)$request->input('review')){
            return response($this->bookRepositories->getReviewBook($request->input('id')));
        }
        elseif ($request->has('id')){
            return response($this->bookRepositories->getBookByID(request('id')));
        }
        else return response($this->bookRepositories->getAllBook());
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
     * For test API
     * @return Application|ResponseFactory|Response
     */
    public function testQuery()
    {
        return response($this->bookRepositories->getTop8BooksMostRating());
    }

    public function sort(Request $request)
    {
        //TODO: Kiem tra sortby:OnSale/Popularity/Price
//        return response($this->bookRepositories->getSortByOnSale());
//        return response($this->bookRepositories->getSortByPopularity());
        return response($this->bookRepositories->getSortByPrice());
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
