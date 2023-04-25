<?php

declare(strict_types=1);

namespace App\Repository;

final class UsersRepository
{
    private \PDO $database;

    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function getDb(): \PDO
    {
        return $this->database;
    }

    public function checkAndGet(int $usersId): object
    {
        $query = 'SELECT * FROM `users` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $usersId);
        $statement->execute();
        $users = $statement->fetchObject();
        if (! $users) {
            throw new \Exception('Users not found.', 404);
        }

        return $users;
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `users` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function create(object $users): object
    {
        $query = 'INSERT INTO `users` (`id`, `name`, `email`, `password`, `token`) VALUES (:id, :name, :email, :password, :token)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $users->id);
        $statement->bindParam('name', $users->name);
        $statement->bindParam('email', $users->email);
        $statement->bindParam('password', $users->password);
        $statement->bindParam('token', $users->token);

        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $users, object $data): object
    {
        if (isset($data->name)) {
            $users->name = $data->name;
        }
        if (isset($data->email)) {
            $users->email = $data->email;
        }
        if (isset($data->password)) {
            $users->password = $data->password;
        }
        if (isset($data->token)) {
            $users->token = $data->token;
        }

        $query = 'UPDATE `users` SET `name` = :name, `email` = :email, `password` = :password, `token` = :token WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $users->id);
        $statement->bindParam('name', $users->name);
        $statement->bindParam('email', $users->email);
        $statement->bindParam('password', $users->password);
        $statement->bindParam('token', $users->token);

        $statement->execute();

        return $this->checkAndGet((int) $users->id);
    }

    public function delete(int $usersId): void
    {
        $query = 'DELETE FROM `users` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $usersId);
        $statement->execute();
    }
}
