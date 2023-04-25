<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\MessagesRepository;

final class MessagesService
{
    private MessagesRepository $messagesRepository;

    public function __construct(MessagesRepository $messagesRepository)
    {
        $this->messagesRepository = $messagesRepository;
    }

    public function checkAndGet(int $messagesId): object
    {
        return $this->messagesRepository->checkAndGet($messagesId);
    }

    public function getAll(): array
    {
        return $this->messagesRepository->getAll();
    }

    public function getOne(int $messagesId): object
    {
        return $this->checkAndGet($messagesId);
    }

    public function create(array $input): object
    {
        $messages = json_decode((string) json_encode($input), false);

        return $this->messagesRepository->create($messages);
    }

    public function update(array $input, int $messagesId): object
    {
        $messages = $this->checkAndGet($messagesId);
        $data = json_decode((string) json_encode($input), false);

        return $this->messagesRepository->update($messages, $data);
    }

    public function delete(int $messagesId): void
    {
        $this->checkAndGet($messagesId);
        $this->messagesRepository->delete($messagesId);
    }
}
