<?php

namespace Mirovit\OneSignal\Endpoints\Traits;

use GuzzleHttp\Exception\ClientException;
use Mirovit\OneSignal\Response\Response;

trait FetchesResource
{
    /**
     * Get a resource by id.
     *
     * @param $id
     * @param array $params
     * @return Response
     */
    public function get($id, array $params = [])
    {
        try {
            $query = '';
            if (count($params) > 0) {
                $query = '?' . http_build_query($params);
            }

            $response = $this->client->get("{$this->getEndpoint()}/{$id}" . $query);
        } catch (ClientException $e) {
            $response = $e->getResponse();
        }

        return $this->toResponse($response);
    }
}