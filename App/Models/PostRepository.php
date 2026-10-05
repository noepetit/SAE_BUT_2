<?php
namespace App\Models;
use PDO;

class PostRepository
{
    public function __construct(private \Includes\Database $connection) {}

}