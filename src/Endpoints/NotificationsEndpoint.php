<?php


namespace Mirovit\OneSignal\Endpoints;


use Mirovit\OneSignal\Endpoints\Traits\CreatesResource;
use Mirovit\OneSignal\Endpoints\Traits\DeletesResource;
use Mirovit\OneSignal\Endpoints\Traits\FetchesResource;
use Mirovit\OneSignal\Endpoints\Traits\ListsResource;
use Mirovit\OneSignal\Endpoints\Traits\UpdatesResource;
use Mirovit\OneSignal\Exceptions\MissingArgumentException;

class NotificationsEndpoint extends Endpoint
{
    use CreatesResource, UpdatesResource, FetchesResource, ListsResource, DeletesResource;

    /**
     * @param array $data
     * @throws MissingArgumentException
     */
    protected function validateCreate(array $data)
    {
        if (!$this->validation()->hasKeys(['app_id'], $data)) {
            throw new MissingArgumentException('The app_id key is required.');
        }

//        if (!$this->validation()->hasKeys(['included_segments'], $data)) {
//            throw new MissingArgumentException('Please provide included_segments');
//        }
    }

    /**
     * @param array $data
     * @throws MissingArgumentException
     */
    protected function validateUpdate(array $data)
    {
        if (!$this->validation()->hasKeys(['app_id'], $data)) {
            throw new MissingArgumentException('The app_id key is required.');
        }
    }
}