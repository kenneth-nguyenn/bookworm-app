<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Repositories\BookRepositories;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response($this->bookRepositories->getAllBook());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $arr = explode("/", $request->url());
        $id = end($arr);
        // TODO: Check dieu kien
        return response($this->bookRepositories->getBookByID($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    public function review(Request $request)
    {
        $arr = explode("/", $request->url());
        $id = array_slice($arr,-2, 1);
        return response($this->bookRepositories->getReviewBook($id));
    }

    /**
     * For test API
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function testQuery(){
        return response($this->bookRepositories->getTop8BooksMostRating());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
