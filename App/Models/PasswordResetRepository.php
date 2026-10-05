<?php
namespace App\Models;
use PDO;

class PasswordResetRepository
{
    public function __construct(private PDO $connection) {}

}