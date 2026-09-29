<?php

namespace App\Views;

class Error
{
    public function __construct(private string $message)
    {
    }

    public function show(): void
    {
        http_response_code(404);
        echo htmlspecialchars($this->message);
    }
}