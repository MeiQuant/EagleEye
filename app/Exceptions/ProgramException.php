<?php

namespace App\Exceptions;
use Exception;

class ProgramException extends Exception{

    protected $message;
    protected $code;

    public function __construct($message, $code = 0)
    {
        $this->message = $message;
        $this->code = $code;

        parent::__construct($message, $code);
    }

    public function getOutCode()
    {
        return $this->code;
    }

    public function getOutMessage()
    {
        return $this->message;
    }

}