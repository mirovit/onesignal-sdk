<?php

namespace Mirovit\OneSignal\Endpoints\Traits;

use Mirovit\OneSignal\Response\Response;

trait DeletesResource
{
    /**
     * Delete a resource.
     *
     * @param $uuid
     * @return Response
     */
    public function delete($uuid)
    {
        $response = $this->client->delete("{$this->getEndpoint()}/{$uuid}");

        return $this->toResponse($response);
    }
}