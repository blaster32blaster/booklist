<?php

namespace Tests\Unit;

use App\Services\CacheService;
use Illuminate\Support\Facades\Cache;
use Tests\Unit\RootTestCase;
use Mockery;
use stdClass;

class CacheServiceTest extends RootTestCase
{
    public $responseData;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * A test for saving to cache
     *
     * @return void
     */
    public function testCacheResponseDataTest()
    {
        Cache::shouldReceive('has')
        ;
        Cache::makePartial();

        $cache = new Cache;
        $cacheService = new CacheService($cache);

        $cacheService->cacheResponseData(['test' => 'data']);

        if (Cache::has('comic-list')) {
            Cache::forget('comic-list');
        }

        Cache::shouldReceive('put')
        ->once()
        ;
        Cache::makePartial();
        $cacheService->cacheResponseData(['test' => 'data']);
    }

    /**
     * A test for reading from cache
     *
     * @return void
     */
    public function testReturnCacheDataTest()
    {
        Cache::shouldReceive('has')
        ;
        Cache::makePartial();

        $cache = new Cache;
        $cacheService = new CacheService($cache);

        $cacheService->returnCacheData(['test' => 'data']);
    }
}
