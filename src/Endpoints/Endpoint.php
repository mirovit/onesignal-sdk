<?php

namespace Mirovit\OneSignal\Endpoints;

use GuzzleHttp\Client;
use Mirovit\OneSignal\Exceptions\MissingArgumentException;
use Mirovit\OneSignal\Response\Response;
use Mirovit\OneSignal\Validators\Validator;
use Psr\Http\Message\MessageInterface;

abstract class Endpoint
{
    /**
     * @var Client
     */
    protected $client;
    protected $endpoint;

    public function __construct(Client $client, $endpoint)
    {
        $this->client = $client;
        $this->endpoint = rtrim($endpoint, '/');

        $this->setEndpoint($this->guessEndpoint());
    }

    /**
     * Parse the response from the API.
     * 
     * @param MessageInterface $response
     * @return Response
     * @codeCoverageIgnore
     */
    public function toResponse(MessageInterface $response)
    {
        $json = $response->getBody()->getContents();
        $toArray = json_decode($json, true);

        return new Response($toArray);
    }

    /**
     * Set an endpoint. If the endpoint contains the current,
     * override it, otherwise add at the end of the current.
     *
     * @param $point
     * @param bool $override
     * @return $this
     */
    protected function setEndpoint($point, $override = false)
    {
        if(strpos($this->endpoint, $point) !== false || $override) {
            $this->endpoint = $point;
        } else {
            $this->endpoint .= '/' . ltrim($point, '/');
        }
        return $this;
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * Try and guess the endpoint for given class.
     *
     * @return string
     */
    public function guessEndpoint()
    {
        // Fully qualified path
        // e.g. \Endpoints\UsersEndpoint
        $fullClass = explode('\\', get_called_class());

        // Get the class name
        $class = array_pop($fullClass);

        // Lowercase, then remove endpoint
        $endpoint = str_replace('endpoint', '', strtolower($class));

        // return in format "/endpoint"
        return sprintf('/%s', $endpoint);
    }

    /**
     * Create a new Endpoint instance.
     *
     * @param $class
     * @return Endpoint
     */
    public function endpoint($class)
    {
        $reflection = new \ReflectionClass($class);
        return $reflection->newInstanceArgs([$this->client, $this->endpoint]);
    }

    /**
     * Simple interface for validation.
     *
     * @return Validator
     */
    public function validation()
    {
        return new Validator;
    }
}