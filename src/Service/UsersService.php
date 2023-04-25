<?php

declare(strict_types=1);

namespace App\Service;
namespace App\Service;

use App\Model\User;

use App\Repository\UsersRepository;

final class UsersService
{
    private UsersRepository $usersRepository;

    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function checkAndGet(int $usersId): object
    {
        return $this->usersRepository->checkAndGet($usersId);
    }

    public function getAll(): array
    {
        return $this->usersRepository->getAll();
    }

    public function getOne(int $usersId): object
    {
        return $this->checkAndGet($usersId);
    }

    public function create(array $input): object
    {
        $users = json_decode((string) json_encode($input), false);

        return $this->usersRepository->create($users);
    }

    public function update(array $input, int $usersId): object
    {
        $users = $this->checkAndGet($usersId);
        $data = json_decode((string) json_encode($input), false);

        return $this->usersRepository->update($users, $data);
    }

    public function delete(int $usersId): void
    {
        $this->checkAndGet($usersId);
        $this->usersRepository->delete($usersId);
    }

    //***** METHODE POUR CREER UN NOUVEL UTILISATEUR***** */
    public function createUser($name, $email, $password): User
    {
        // Générer un token d'authentification
        $token = bin2hex(random_bytes(32));
        // Créer un nouvel utilisateur
        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
        // Hasher le mot de passe avant de le stocker
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user->setPassword($hashedPassword);
        $user->setAuthToken($token);

        // Enregistrer l'utilisateur dans la base de données
        $this->userRepository->save($user);

        return $user;
    }
}
