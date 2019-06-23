<?php


namespace Mirovit\OneSignal\Endpoints;


use Mirovit\OneSignal\Endpoints\Traits\FetchesResource;
use Mirovit\OneSignal\Endpoints\Traits\ListsResource;

class AppsEndpoint extends Endpoint
{
    use ListsResource, FetchesResource;
}