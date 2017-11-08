<?php

namespace Blogg\Exceptions;

use Exception;

class ExceededMaxAllowedException extends Exception
{
    public function __construct($message = null)
    {
        $message = $message ?: 'Exceeded max allowed.';
        parent::__construct($message);
    }
}
