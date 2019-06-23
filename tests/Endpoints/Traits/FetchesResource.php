<?php

namespace Mirovit\OneSignal\Tests\Endpoints\Traits;

use Mirovit\OneSignal\Response\Response;

trait FetchesResource
{
    /** @test */
    public function it_gets_a_resource()
    {
        $id = 'fake-id';

        $this->client
            ->get("{$this->endpoint}{$this->resource}/{$id}")
            ->shouldBeCalled()
            ->willReturn($this->successResponse->reveal());

        $resource = new $this->endpointClass(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertInstanceOf(
            Response::class,
            $resource->get($id)
        );
    }
}