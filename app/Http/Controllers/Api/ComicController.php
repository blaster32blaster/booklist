<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CacheService;
use App\Services\ComicService;
use Illuminate\Http\Request;

/**
 * handle comic data
 */
class ComicController extends Controller
{
    /**
     * a comic service instance
     *
     * @var ComicService $comicService
     */
    private $comicService;

    /**
     * a cache service instance
     *
     * @var CacheService $cacheService
     */
    private $cacheService;

    public function __construct(ComicService $cs, CacheService $cService)
    {
        $this->comicService = $cs;
        $this->cacheService = $cService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cache = $this->cacheService->returnCacheData();

        if (!empty($cache)) {
            return response($cache);
        }

        $response = $this->comicService->index();

        $this->cacheService->cacheResponseData($response);

        return response($response);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
