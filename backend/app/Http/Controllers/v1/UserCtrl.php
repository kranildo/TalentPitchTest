<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\User\UserCreateRequest;
use App\Http\Requests\v1\User\UserEditRequest;
use App\Http\Requests\v1\User\UserChangePasswordRequest;
use App\Services\Implementation\UserService;
use Illuminate\Http\Request;

/**
 * @group User
 * User Management APIs
 */
class UserCtrl extends Controller
{
    private $service;

    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }
    public function create(UserCreateRequest $request)
    {
        $me = auth('api')->user();
        if (!$me->hasAnyPermission(['user.create'])) {
            return $this->Json(403, "Without permission");
        }
        $user = $this->service->createUser($request->all());
        if ($user) {
            return $this->Json(201, "Saved successfully", $user->toArray());
        }
        return $this->Json(304, "Error saving");
    }
    public function search(Request $request)
    {
        $me = auth('api')->user();
        if (!$me->hasAnyPermission(['user.search'])) {
            return $this->Json(403, "Without permission");
        }
        $user = $this->service->fetchUser($request->all());
        if ($user->count() > 0) {
            return $this->Json(200, "Found data", $user->toArray());
        }
        return $this->Json(404, "Data not found");
    }

    public function edit(UserEditRequest $request, $id)
    {
        $me = auth('api')->user();
        if (!$me->hasAnyPermission(['user.edit'])) {
            return $this->Json(403, "Without permission");
        }
        $user = $this->service->editUser($request->all(), $id);
        if ($user) {
            return $this->Json(202, "Successfully updated", $user->toArray());
        }
        return $this->Json(404, "Data not found");
    }

    public function changePwd(UserChangePasswordRequest $request, $id)
    {
        $me = auth('api')->user();
        if (!$me->hasAnyPermission(['user.changePwd'])) {
            return $this->Json(403, "Without permission");
        }
        $user = $this->service->changeUserPassword($request->all(), $id);
        if ($user) {
            return $this->Json(202, "Successfully updated", $user->toArray());
        }
        return $this->Json(404, "Data not found");
    }

    public function exclude($id)
    {
        $me = auth('api')->user();
        if (!$me->hasAnyPermission(['user.exclude'])) {
            return $this->Json(403, "Without permission");
        }
        $user = $this->service->deleteUser($id);
        if ($user) {
            return $this->Json(204, "Successfully deleted");
        }
        return $this->Json(404, "Data not found");
    }

    public function searchExcludes(Request $request)
    {
        $me = auth('api')->user();
        if (!$me->hasAnyPermission(['user.searchExcludes'])) {
            return $this->Json(403, "Without permission");
        }
        $user = $this->service->getExcludedUser($request->all());
        if ($user->count() > 0) {
            return $this->Json(200, "Found data", $user->toArray());
        }
        return $this->Json(404, "Data not found");
    }

    public function restore($id)
    {
        $me = auth('api')->user();
        if (!$me->hasAnyPermission(['user.restore'])) {
            return $this->Json(403, "Without permission");
        }
        $user = $this->service->restoreUser($id);
        if ($user) {
            $user = $this->service->getUserById($id);
            return $this->Json(201, "Successfully restored", $user->toArray());
        }
        return $this->Json(404, "Data not found");
    }

    public function getById($id)
    {

        $me = auth('api')->user();
        if (!$me->hasAnyPermission(['user.getbyid'])) {
            return $this->Json(403, "Without permission");
        }

        $user = $this->service->getUserById($id);
        if ($user) {
            return $this->Json(200, "Found data", $user->toArray());
        }
        return $this->Json(404, "Data not found");
    }
}
