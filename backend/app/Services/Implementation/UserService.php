<?php

namespace App\Services\Implementation;

use App\Models\User;
use App\Services\Interfaces\IUserService;

class UserService implements IUserService
{
    private $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function createUser(array $user)
    {
        $user['password'] = app('hash')->make($user['password']);
        return $this->model->create($user);
    }

    public function fetchUser(array $filtro)
    {
        $per_page = empty($filtro["per_page"]) ?  null : $filtro["per_page"];
        $query = $this->model->newQuery();
        $query->filtrar($filtro);
        $users = $query->paginate($per_page);
        return $users;
    } 

    public function getUserById(int $id)
    {
        $user = $this->model->find($id);
        if ($user) {
            return $user;
        }
        return false;
    }

    public function editUser(array $user, int $id)
    {
        $data = $this->model->find($id);
        if ($data) {
            $data->fill($user)->save();
            return $data;
        }
        return null;
    }

    public function changeUserPassword(array $user, int $id)
    {
        $data = $this->model->find($id);
        //dd(app('hash')->check($user['password_atual'], $data->password));
        if ($data) {
            $user['password'] = app('hash')->make($user['password']);
            $data->fill($user)->save();
            return $data;
        }
        return null;
    }

    public function deleteUser(int $id)
    {
        $data = $this->model->find($id);
        if ($data) {
            return $data->delete();
        }
        return false;
    }

    public function getExcludedUser(array $filtro)
    {
        $per_page = empty($filtro["per_page"]) ?  null : $filtro["per_page"];
        $query = $this->model->newQuery();
        $query->whereNotNull('deleted_at');
        $query->withTrashed();
        $query->filtrar($filtro);
        $users = $query->paginate($per_page);
        return $users;
    }

    public function restoreUser(int $id)
    {
        $user = $this->model->withTrashed()->find($id);
        if ($user) {
            return $user->restore();
        }
        return false;
    }
}
