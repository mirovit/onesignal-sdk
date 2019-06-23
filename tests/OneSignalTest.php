<?php

namespace Mirovit\OneSignal\Tests;

use Mirovit\OneSignal\Endpoints\AppsEndpoint;
use Mirovit\OneSignal\Endpoints\Endpoint;
use Mirovit\OneSignal\Endpoints\PlayersEndpoint;
use Mirovit\OneSignal\OneSignal;
use Mirovit\OneSignal\Validators\Validator;

class OneSignalTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var OneSignal
     */
    private $oneSignal;

    public function setUp()
    {
        $this->oneSignal = new OneSignal('faketoken', 'http://api.fakeserver.com');
    }

    /** @test */
    public function it_is_an_instance_of_endpoint()
    {
        $this->assertInstanceOf(Endpoint::class, $this->oneSignal);
    }

    /** @test */
    public function it_sets_correct_endpoint()
    {
        $this->assertSame('http://api.fakeserver.com', $this->oneSignal->getEndpoint());
    }

    /** @test */
    public function it_has_apps_endpoint()
    {
        $this->assertTrue(method_exists($this->oneSignal, 'apps'));
        $this->assertInstanceOf(AppsEndpoint::class, $this->oneSignal->apps());
    }

    /** @test */
    public function it_has_players_endpoint()
    {
        $this->assertTrue(method_exists($this->oneSignal, 'players'));
        $this->assertInstanceOf(PlayersEndpoint::class, $this->oneSignal->players());
    }

    /** @test */
    public function it_has_a_validator_instance()
    {
        $this->assertInstanceOf(Validator::class, $this->oneSignal->validation());
    }
}