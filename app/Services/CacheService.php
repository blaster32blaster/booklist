<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Psr\SimpleCache\CacheException;
use Exception;

/**
 * handle writing and reading from cache
 */
class CacheService
{
    /**
     * a cache facade
     *
     * @var Cache $cache
     */
    private $cache;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * cache response data
     *
     * @param Object $response
     * @return void
     */
    public function cacheResponseData($response) : void
    {
        try {
            if ($this->cache::has('comic-list')) {
                $this->cache::forget(('comic-list'));
            }
            $this->cache::put('comic-list', $response, 240);
            logger()->info('comic-list data set in cache');
        } catch (CacheException $e) {
            logger()->error('Comic Service Cache Storing Exception');
        } catch (Exception $e) {
            logger()->error('Comic Service Cache Storing General Exception', [
                'cache_exception' => $e->getMessage(),
                'stack' => $e->getTraceAsString()
            ]);
        }
    }

    /**
     * return data from the cache
     *
     * @return array
     */
    public function returnCacheData() : array
    {
        try {
            if ($this->cache::has('comic-list')) {
                logger()->info('fetching comic list from cache');
                return $this->cache::get('comic-list');
            }
        } catch (CacheException $e) {
            logger()->error('Comic Service Cache Fetch Exception');
        } catch (Exception $e) {
            logger()->error('Comic Service Cache Fetch General Exception', [
                'cache_exception' => $e->getMessage(),
                'stack' => $e->getTraceAsString()
            ]);
        }
        return [];
    }

}
