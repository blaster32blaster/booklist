<?php

namespace Tests\Unit;

use App\Services\RequestService;
use Tests\Unit\RootTestCase;
use Mockery;
use stdClass;

class RequestServiceTest extends RootTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $mock = $this->mock(RequestService::class, function ($mock) {
            $mock
            ->shouldReceive('fetch')
            ->once();
        });
        $mock->makePartial();
        $response = $mock->fetch('http://laravel.com', 'b', 'c', 'd');
    }
}
