<?php

namespace App\Services;

use App\Exceptions\CachingException;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Psr\SimpleCache\CacheException;

class ComicService
{
    /**
     * the endpoint to hit
     *
     * @var [type]
     */
    private $endpoint;

    /**
     * a timestamp
     *
     * @var string $ts
     */
    private $ts;

    /**
     * md5 hashed keys and ts
     *
     * @var string $hashedKey
     */
    private $hashedKey;

    public function __construct()
    {
        $this->endpoint = 'comics';
        $this->ts = Carbon::now()->timestamp;
        $this->hashedKey = md5(
            $this->ts . config('booklist.marvel_private') . config('booklist.marvel_public')
        );
    }

    /**
     * index method that handles returning comics data
     *
     * @return Response
     */
    public function index() : Response
    {
        try {
            $cache = $this->returnCacheData();

            if (!empty($cache)) {
                return response($cache);
            }

            $response = Http::get(
                config('booklist.marvel_base_url') . $this->endpoint, [
                    'apikey' => config('booklist.marvel_public'),
                    'ts' => $this->ts,
                    'hash' => $this->hashedKey
                    ]
                );
            $this->cacheResponseData($response);
            return response($response['data']['results']);
        } catch (CachingException $e) {
            logger()->error('Comic Service Caching Exception');
        } catch (RequestException $e) {
            logger()->error('Comic Service Request Exception', [
                'marvel_exception' => $e->getMessage(),
                'stack' => $e->getTraceAsString()
            ]);
        } catch (Exception $e) {
            logger()->error('Comic Service General Exception', [
                'marvel_exception' => $e->getMessage(),
                'stack' => $e->getTraceAsString()
            ]);
        }
        return response('comic fetch error', 400);
    }

    /**
     * cache response data
     *
     * @param Object $response
     * @return void
     */
    private function cacheResponseData($response) : void
    {
        try {
            if (Cache::has('comic-list')) {
                Cache::forget(('comic-list'));
            }
            Cache::put('comic-list', $response['data']['results'], 240);
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
    private function returnCacheData() : array
    {
        try {
            if (Cache::has('comic-list')) {
                logger()->info('fetching comic list from cache');
                return Cache::get('comic-list');
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
