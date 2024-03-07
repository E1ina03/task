<?php

declare(strict_types=1);

namespace App\Exceptions;

class Exception extends \Exception
{
//    protected $message;
//
//    /**
//     * @param string $message
//     */
//    public function __construct(string $message)
//    {
//        $this->message = $message;
//    }

//    public function getMessage(): string
//    {
//        return $this->message;
//    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
}
