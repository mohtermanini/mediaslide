<?php

namespace App\Services;

use App\Interfaces\Repositories\UserRepositoryInterface;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUser($id)
    {
        $user = $this->userRepository->findById($id);

        if (!$user) {
            throw new \Exception('User Not Found.', 404);
        }

        return $user;
    }

    public function getUserByEmail($email = null)
    {
        return $this->userRepository->findByEmail($email);
    }
}
