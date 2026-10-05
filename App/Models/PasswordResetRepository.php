<?php
namespace App\Models;

use PDO;

class PasswordResetRepository
{
    public function __construct(private PDO $connection) {}

    public function createResetToken(int $user_id, string $token_hash): void
    {
        $statement = $this->connection->prepare(
            'INSERT INTO password_resets (user_id, token, expires_at)
             VALUES (?, ?, NOW() + INTERVAL 30 MINUTE)
             ON DUPLICATE KEY UPDATE
                 token = ?,
                 expires_at = NOW() + INTERVAL 30 MINUTE,
                 created_at = NOW()'
        );
        $statement->execute([$user_id, $token_hash, $token_hash]);
    }

    public function findValidByToken(string $token_hash): ?object
    {
        $statement = $this->connection->prepare(
            'SELECT user_id FROM password_resets
             WHERE token = ? AND expires_at > NOW()
             LIMIT 1 FOR UPDATE'
        );
        $statement->execute([$token_hash]);
        return $statement->fetchObject() ?: null;
    }

    public function deleteByUserId(int $userId): void
    {
        $statement = $this->connection->prepare(
            'DELETE FROM password_resets WHERE user_id = ?'
        );
        $statement->execute([$userId]);
    }

    public function deleteToken(string $token_hash): void
    {
        $statement = $this->connection->prepare(
            'DELETE FROM password_resets WHERE token = ?'
        );
        $statement->execute([$token_hash]);
    }
}
