<?php

namespace Mirovit\OneSignal;

use GuzzleHttp\Client;
use Mirovit\OneSignal\Endpoints\AppsEndpoint;
use Mirovit\OneSignal\Endpoints\Endpoint;
use Mirovit\OneSignal\Endpoints\NotificationsEndpoint;
use Mirovit\OneSignal\Endpoints\PlayersEndpoint;

class OneSignal extends Endpoint
{
    /**
     * @param string $apiKey
     * @param string $endpoint
     */
    public function __construct($apiKey = null, $endpoint = 'https://onesignal.com/api/v1')
    {
        $apiKey = $apiKey === null ? getenv('ONESIGNAL_API_KEY') : $apiKey;

        $this->client = new Client([
            'headers' => [
                'Authorization' => "Basic {$apiKey}",
                'Content-Type'  => 'application/json',
            ],
            'debug' => true
        ]);

        parent::__construct($this->client, $endpoint);

        $this->setEndpoint($endpoint, true);
    }

    public function apps()
    {
        return $this->endpoint(AppsEndpoint::class);
    }

    public function players()
    {
        return $this->endpoint(PlayersEndpoint::class);
    }

    /*
     * @method create()
     */
    public function notifications()
    {
        return $this->endpoint(NotificationsEndpoint::class);
    }
}