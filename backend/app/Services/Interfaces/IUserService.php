<?php

namespace App\Services\Interfaces;

interface IUserService
{
    public function createUser(array $user);
    public function fetchUser(array $filter);
    public function getUserById(int $id);
    public function editUser(array $user, int $id);
    public function changeUserPassword(array $user, int $id);
    public function deleteUser(int $id);
    public function getExcludedUser(array $filter);
    public function restoreUser(int $id);
}
