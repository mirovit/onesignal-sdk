<?php

namespace Mirovit\OneSignal\Tests\Endpoints;

use Mirovit\OneSignal\Endpoints\NotificationsEndpoint;
use Mirovit\OneSignal\Tests\Endpoints\Traits\DeletesResource;
use Mirovit\OneSignal\Tests\Endpoints\Traits\FetchesResource;
use Mirovit\OneSignal\Tests\Endpoints\Traits\ListsResource;
use Mirovit\OneSignal\Endpoints\UsersEndpoint;
use Mirovit\OneSignal\Response\Response;

class NotificationsEndpointTest extends AbstractEndpointTest
{
    use FetchesResource,
        DeletesResource,
        ListsResource;

    public function setUp()
    {
        parent::setUp();

        $this->resource = '/notifications';
        $this->endpointClass = NotificationsEndpoint::class;
    }

    /** @test */
    public function it_updates_notification_when_correct_data_is_passed()
    {
        $notification = [
            'id'       => 'fake-id',
            'app_id'   => 'app-id',
            'email'    => 'john@doe.com',
        ];

        $this->client
            ->put("{$this->endpoint}{$this->resource}/{$notification['id']}", ['body' => json_encode($notification)])
            ->shouldBeCalled()
            ->willReturn($this->successResponse->reveal());

        $endpoint = new NotificationsEndpoint(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertInstanceOf(
            Response::class,
            $endpoint->update($notification)
        );
    }

    /**
     * @test
     * @expectedException \Mirovit\OneSignal\Exceptions\MissingArgumentException
     */
    public function it_throws_an_exception_when_missing_required_parameters_in_update()
    {
        $endpoint = new NotificationsEndpoint(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertInstanceOf(
            Response::class,
            $endpoint->update([])
        );
    }
}