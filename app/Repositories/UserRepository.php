<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function filterAndSortUsers(array $data)
    {
        return User::query()
            ->filter($data)
            ->orderBy($data['orderBy'], $data['order'])
            ->get()
            ->toArray();
    }

    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function updateUser(int $id, array $data): bool
    {
        $user = User::find($id);
        return $user ? $user->update($data) : false;
    }

    public function deleteUser(int $id): bool
    {
        $user = User::find($id);
        return $user ? $user->delete() : false;
    }
}
