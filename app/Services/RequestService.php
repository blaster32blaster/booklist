<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;


/**
 * the class for making http requests
 */
class RequestService
{
    /**
     * teh http service
     *
     * @var Http $httpService
     */
    private $httpService;

    public function __construct(Http $hService)
    {
        $this->httpService = $hService;
    }

    /**
     * fetch comic list from marvel
     *
     * @param string $url
     * @param string $apiKey
     * @param string $timestamp
     * @param string $requestHash / timestamp / public / private
     * @return Response
     */
    public function fetch(
        $url,
        $apiKey,
        $timestamp,
        $requestHash
    ) : Response {
        return $this->httpService::get(
            $url, [
                'apikey' => $apiKey,
                'ts' => $timestamp,
                'hash' => $requestHash
                ]
            );
    }
}
