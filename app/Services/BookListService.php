<?php

namespace App\Services;

use Illuminate\View\View;

/**
 * service for handling main book list
 */
class BookListService
{
 /**
     * the index method for the book list
     *
     * @return View
     */
    public function index() : View
    {
        return view('booklist')->with('title', 'Comic List');
    }
}
