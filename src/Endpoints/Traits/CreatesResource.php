<?php

namespace Mirovit\OneSignal\Endpoints\Traits;

use Mirovit\OneSignal\Contracts\Arrayable;
use Mirovit\OneSignal\Exceptions\MissingArgumentException;
use Mirovit\OneSignal\Response\Response;

trait CreatesResource
{
    /**
     * @param array $data
     * @throws MissingArgumentException
     */
    abstract protected function validateCreate(array $data);

    /**
     * Creates a new resource.
     *
     * @param array $data
     * @return Response
     */
    public function create(array $data)
    {
        $this->validateCreate($data);

        foreach($data as $key => $item) {
            if($item instanceof Arrayable) {
                $data[$key] = $item->toArray();
            }
        }

        var_dump($data);

        $response = $this->client->post($this->getEndpoint(), [
            'body' => json_encode($data),
        ]);

        return $this->toResponse($response);
    }
}