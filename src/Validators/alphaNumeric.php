<?php

namespace Mirovit\OneSignal\Validators;

use Mirovit\OneSignal\Contracts\Validatable;

class AlphaNumeric implements Validatable
{
    /**
     * @var string
     */
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function validate()
    {
        // TODO: Implement validate() method.
    }
}