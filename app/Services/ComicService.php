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
     * @var string $endpoint
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

    /**
     * a request service instance
     *
     * @var RequestService $requestService
     */
    private $requestService;

    public function __construct(RequestService $rService)
    {
        $this->endpoint = 'comics';
        $this->ts = Carbon::now()->timestamp;
        $this->hashedKey = md5(
            $this->ts . config('booklist.marvel_private') . config('booklist.marvel_public')
        );
        $this->requestService = $rService;
    }

    /**
     * index method that handles returning comics data
     *
     * @return Response
     */
    public function index() : Response
    {
        try {
            $response = $this->requestService->fetch(
                config('booklist.marvel_base_url') . $this->endpoint,
                config('booklist.marvel_public'),
                $this->ts,
                $this->hashedKey
            );

            return response($response['data']['results']);

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
}
