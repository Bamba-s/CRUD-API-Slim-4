<?php

declare(strict_types=1);

namespace App\Repository;

final class MessagesRepository
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

    public function checkAndGet(int $messagesId): object
    {
        $query = 'SELECT * FROM `messages` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $messagesId);
        $statement->execute();
        $messages = $statement->fetchObject();
        if (! $messages) {
            throw new \Exception('Messages not found.', 404);
        }

        return $messages;
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `messages` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function create(object $messages): object
    {
        $query = 'INSERT INTO `messages` (`id`, `title`, `description`) VALUES (:id, :title, :description)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $messages->id);
        $statement->bindParam('title', $messages->title);
        $statement->bindParam('description', $messages->description);

        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $messages, object $data): object
    {
        if (isset($data->title)) {
            $messages->title = $data->title;
        }
        if (isset($data->description)) {
            $messages->description = $data->description;
        }

        $query = 'UPDATE `messages` SET `title` = :title, `description` = :description WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $messages->id);
        $statement->bindParam('title', $messages->title);
        $statement->bindParam('description', $messages->description);

        $statement->execute();

        return $this->checkAndGet((int) $messages->id);
    }

    public function delete(int $messagesId): void
    {
        $query = 'DELETE FROM `messages` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $messagesId);
        $statement->execute();
    }
}
