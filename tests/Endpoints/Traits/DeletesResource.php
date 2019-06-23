<?php

namespace Mirovit\OneSignal\Tests\Endpoints\Traits;

use Mirovit\OneSignal\Response\Response;

trait DeletesResource
{
    /** @test */
    public function it_deletes_a_resource()
    {
        $id = 'fake-id';

        $this->client
            ->delete("{$this->endpoint}{$this->resource}/{$id}")
            ->shouldBeCalled()
            ->willReturn($this->successResponse->reveal());

        $resource = new $this->endpointClass(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertInstanceOf(
            Response::class,
            $resource->delete($id)
        );
    }
}