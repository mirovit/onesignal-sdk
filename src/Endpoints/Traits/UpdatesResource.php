<?php

namespace Mirovit\OneSignal\Endpoints\Traits;

use Mirovit\OneSignal\Contracts\Arrayable;
use Mirovit\OneSignal\Exceptions\MissingArgumentException;
use Mirovit\OneSignal\Response\Response;

trait UpdatesResource
{
    /**
     * @param array $data
     * @throws MissingArgumentException
     */
    abstract protected function validateUpdate(array $data);

    /**
     * Update a resource.
     *
     * @param array $data
     * @return Response
     */
    public function update(array $data)
    {
        $this->validateUpdate($data);

        foreach($data as $key => $item) {
            if($item instanceof Arrayable) {
                $data[$key] = $item->toArray();
            }
        }

        $response = $this->client->put(
            "{$this->getEndpoint()}/{$data['id']}",
            [
                'body' => json_encode($data),
            ]
        );

        return $this->toResponse($response);
    }
}