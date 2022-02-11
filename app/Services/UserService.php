<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUsers()
    {
        return $this->userRepository->getUsers();
    }

    public function createUser(array $attributes)
    {
        return $this->userRepository->createUser($attributes);
    }

    public function updateUser($id, array $attributes)
    {
        return $this->userRepository->updateUser($id, $attributes);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->deleteUser($id);
    }
}
