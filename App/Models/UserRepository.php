<?php
namespace App\Models;
use PDO;

class UserRepository
{
    public function __construct(private PDO $connection) {}
    // Fonction de création d'un utilisateur
    public function createUser(string $email, string $username, string $first_name, string $last_name, string $pwdHash): void
    {
        $statement = $this->connection->prepare('INSERT INTO Users (email, username, first_name, last_name, pwd_hash) VALUES (?, ?, ?, ?, ?)');
        $statement->execute([$email, $username, $first_name, $last_name, $pwdHash]);
    }
    // Fonction pour retrouver un utilisateur selon un email
    public function findByEmail(string $email): ?object
    {
        $statement = $this->connection->prepare('SELECT id, email, username, first_name, last_name, pwd_hash FROM Users WHERE email = ?');
        $statement->execute([$email]);
        return $statement->fetchObject() ?: null;
    }

    // Fonction pour retrouver un utilisateur selon son ID
    public function findById(int $id): ?object
    {
        $statement = $this->connection->prepare('SELECT id, email, username, first_name, last_name FROM Users WHERE id = ?');
        $statement->execute([$id]);
        return $statement->fetchObject() ?: null;
    }
    // Vérification si l'email ou l'username est deja utilisé
    public function emailOrUsernameExists(string $email, string $username): bool
    {
        $statement = $this->connection->prepare('SELECT COUNT(*) FROM Users WHERE email = ? OR username = ?');
        $statement->execute([$email, $username]);
        if ($statement->fetchColumn() > 0) {
            return true;
        }
        return false;
    }
    public function updatePwd(int $id, string $newPwdHash): void
    {
        $statement = $this->connection->prepare('UPDATE Users SET pwd_hash = ? WHERE id = ?');
        $statement->execute([$newPwdHash, $id]);
    }

    public function deleteUser(int $id): void
    {
        $statement = $this->connection->prepare('DELETE FROM Users WHERE id = ?');
        $statement->execute([$id]);
    }
}