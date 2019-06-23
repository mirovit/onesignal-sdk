<?php

namespace Mirovit\OneSignal\Tests\Endpoints;

use Mirovit\OneSignal\Endpoints\AppsEndpoint;
use Mirovit\OneSignal\Tests\Endpoints\Traits\FetchesResource;
use Mirovit\OneSignal\Tests\Endpoints\Traits\ListsResource;

class AppsEndpointTest extends AbstractEndpointTest
{
    use FetchesResource,
        ListsResource;

    public function setUp()
    {
        parent::setUp();

        $this->resource = '/apps';
        $this->endpointClass = AppsEndpoint::class;
    }
}
