<?php
namespace App\Models;
use PDO;

class PasswordResetRepository
{
    public function __construct(private PDO $connection) {}
    private function createResetToken(int $user_id, int $token_hash): void
    {
        $statement = $this->connection->prepare(
            'INSERT INTO password_resets (user_id, token, expires_at) 
                    VALUES (?, ?, NOW() + INTERVAL 30 MINUTE)
                    ON DUPLICATE KEY UPDATE token = VALUES(token), expires_at = VALUES(expires_at), created_at = NOW()');
        $statement->execute([$user_id, $token_hash]);
    }

    public function findValidByToken(string $token_hash): ?object
    {
        $statement = $this->connection->prepare(
            'SELECT user_id FROM password_resets WHERE token = ? AND expires_At > NOW() LIMIT 1'
        );
        $statement->execute([$token_hash]);
        return $statement->fetchObject() ?: null;
    }

    private function deleteByUserId(int $userId): void
    {
        $statement = $this->connection->prepare(
        'DELETE FROM password_resets WHERE user_id = ?'
        );
        $statement->execute([$userId]);
    }

}