<?php

namespace App\Exceptions;
use Exception;


class ShellException extends Exception{

    private $message;
    private $code;

    public function __construct($message, $code, Exception $previous)
    {
        $this->message = $message;
        $this->code = $code;

        parent::__construct($message, $code, $previous);
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