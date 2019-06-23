<?php

namespace Mirovit\OneSignal\Endpoints\Traits;

use GuzzleHttp\Exception\ClientException;
use Mirovit\OneSignal\Response\Response;

trait ListsResource
{
    /**
     * Get all from resource.
     *
     * @param array $params
     * @return Response
     */
    public function all(array $params = [])
    {
        try {
            $query = '';
            if(count($params) > 0) {
                $query = '?' . http_build_query($params);
            }

            $response = $this->client->get($this->getEndpoint() . $query);
        } catch (ClientException $e) {
            $response = $e->getResponse();
        }

        return $this->toResponse($response);
    }
}