<?php
namespace App\Views;

class ResetPasswordView
{
    public function __construct(
        private array $error = [],
        private string $token,
        private bool $valid_token,
    ) {}
}