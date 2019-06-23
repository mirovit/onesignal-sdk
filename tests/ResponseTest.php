<?php

namespace Mirovit\OneSignal\Tests;

use Mirovit\OneSignal\Response\Response;
use Mirovit\OneSignal\Response\ResponseData;
use Mirovit\OneSignal\Response\ResponseError;
use Mirovit\OneSignal\Response\ResponseMeta;

class ResponseTest extends \PHPUnit_Framework_TestCase
{
    protected $successResponse = [];
    protected $errorResponse = [];

    public function setUp()
    {
        $this->successResponse = [
            'success' => true
        ];

        $this->errorResponse = [
            'error'  => [
                'message'   => 'Authorization header is missing.',
            ],
        ];
    }

    /** @test */
    public function it_fills_a_success_response_correctly()
    {
        $response = new Response($this->successResponse);

        $this->assertTrue($response->isSuccessful());
        $this->assertSame($this->successResponse['status'], $response->get('status'));
        $this->assertSame($this->successResponse, $response->toArray());
    }
    
    /** @test */
    public function it_fills_an_error_response_correctly()
    {
        $response = new Response($this->errorResponse);

        $this->assertFalse($response->isSuccessful());
    }
    
    /** @test */
    public function it_returns_default_value_when_one_does_not_exist()
    {
        $response = new Response($this->successResponse);

        $this->assertNull($response->get('blah'));
    }
    
    /** @test */
    public function it_does_correct_check_for_key_existence()
    {
        $response = new Response($this->successResponse);

        $this->assertTrue($response->has('success'));
        $this->assertFalse($response->has('blah'));
    }

    /** @test */
    public function it_uses_the_magic_get()
    {
        $response = new Response($this->successResponse);

        $this->assertSame($this->successResponse['success'], $response->success);
    }
}
