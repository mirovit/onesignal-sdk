<?php

namespace Mirovit\OneSignal\Tests\Endpoints;

use Mirovit\OneSignal\Endpoints\PlayersEndpoint;
use Mirovit\OneSignal\Tests\Endpoints\Traits\FetchesResource;
use Mirovit\OneSignal\Tests\Endpoints\Traits\ListsResource;
use Mirovit\OneSignal\Response\Response;

class PlayersEndpointTest extends AbstractEndpointTest
{
    use FetchesResource,
        ListsResource;

    public function setUp()
    {
        parent::setUp();

        $this->resource = '/players';
        $this->endpointClass = PlayersEndpoint::class;
    }

    /** @test */
    public function it_updates_player_when_correct_data_is_passed()
    {
        $player = [
            'id'       => 'fake-id',
            'app_id'   => 'app-id',
            'email'    => 'john@doe.com',
        ];

        $this->client
            ->put("{$this->endpoint}{$this->resource}/{$player['id']}", ['body' => json_encode($player)])
            ->shouldBeCalled()
            ->willReturn($this->successResponse->reveal());

        $endpoint = new PlayersEndpoint(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertInstanceOf(
            Response::class,
            $endpoint->update($player)
        );
    }

    /**
     * @test
     * @expectedException \Mirovit\OneSignal\Exceptions\MissingArgumentException
     */
    public function it_throws_an_exception_when_missing_required_parameters_in_update()
    {
        $playersEndpoint = new PlayersEndpoint(
            $this->client->reveal(),
            $this->endpoint
        );

        $this->assertInstanceOf(
            Response::class,
            $playersEndpoint->update([])
        );
    }
}