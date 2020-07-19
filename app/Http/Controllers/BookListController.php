<?php

namespace App\Http\Controllers;

use App\Services\BookListService;
use Illuminate\View\View;

/**
 * Class for handling the main booklist
 */
class BookListController extends Controller
{
    /**
     * a book list  service instance
     *
     * @var BookListService $bookListService
     */
    private $bookListService;

    public function __construct(BookListService $bs)
    {
        $this->bookListService = $bs;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index() : View
    {
        return $this->bookListService->index();
    }
}
