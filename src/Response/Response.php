<?php

namespace Mirovit\OneSignal\Response;

class Response extends Responder
{
    public function __construct(array $response)
    {
        parent::__construct($response);
    }

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->get('success') == true;
    }
}