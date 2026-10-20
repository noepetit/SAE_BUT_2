<?php

namespace App\Views;

class Error
{
    public function __construct(private string $message, private int $code = 404)
    {
    }

    public function show(): void
    {
        http_response_code($this->code);
        $content = '<section class="error"><h1>Erreur</h1><p>' . htmlspecialchars($this->message) . '</p></section>';
        (new Layout('Erreur', $content))->show();
    }
}