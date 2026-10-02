<?php

namespace App\Views;

class Error
{
    private $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function show(): void
    {
        http_response_code(404);
        echo htmlspecialchars($this->message);
    }
}