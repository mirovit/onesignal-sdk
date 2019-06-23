<?php


namespace Mirovit\OneSignal\Endpoints;

use Mirovit\OneSignal\Endpoints\Traits\FetchesResource;
use Mirovit\OneSignal\Endpoints\Traits\ListsResource;
use Mirovit\OneSignal\Endpoints\Traits\UpdatesResource;
use Mirovit\OneSignal\Exceptions\MissingArgumentException;

class PlayersEndpoint extends Endpoint
{
    use ListsResource, FetchesResource, UpdatesResource;

    /**
     * @param array $data
     * @throws MissingArgumentException
     */
    protected function validateUpdate(array $data)
    {
        if (!$this->validation()->hasKeys(['id'], $data)) {
            throw new MissingArgumentException('The Player Id is required [field "id"].');
        }

        if (!$this->validation()->hasKeys(['app_id'], $data)) {
            throw new MissingArgumentException('The app_id key is required.');
        }
    }
}