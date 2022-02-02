<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Employees\EmployeesCreateRequest;
use App\Http\Requests\v1\Employees\EmployeesEditRequest;
use App\Services\Implementation\EmployeesService;
use Illuminate\Http\Request;

/**
 * @group Employees
 * Employees Management APIs
 */
class EmployeesCtrl extends Controller
{
    private $service;

    public function __construct(EmployeesService $Service)
    {
        $this->service = $Service;
    }
    public function create(EmployeesCreateRequest $request)
    {
        $me = auth('api')->user();
        if (!$me->hasAnyPermission(['employees.create'])) {
            return $this->Json(403, "Without permission");
        }
        $user = $this->service->createEmployees($request->all());
        if ($user) {
            return $this->Json(201, "Saved successfully", $user->toArray());
        }
        return $this->Json(304, "Error saving");
    }
    public function search(Request $request)
    {
        $me = auth('api')->user();
        if (!$me->hasAnyPermission(['employees.search'])) {
            return $this->Json(403, "Without permission");
        }
        $user = $this->service->fetchEmployees($request->all());
        if ($user->count() > 0) {
            return $this->Json(200, "Found data", $user->toArray());
        }
        return $this->Json(404, "Data not found");
    }

    public function edit(EmployeesEditRequest $request, $id)
    {
        $me = auth('api')->user();
        if (!$me->hasAnyPermission(['employees.edit'])) {
            return $this->Json(403, "Without permission");
        }
        $user = $this->service->editEmployees($request->all(), $id);
        if ($user) {
            return $this->Json(202, "Successfully updated", $user->toArray());
        }
        return $this->Json(404, "Data not found");
    }

    public function exclude($id)
    {
        $me = auth('api')->user();
        if (!$me->hasAnyPermission(['employees.exclude'])) {
            return $this->Json(403, "Without permission");
        }
        $user = $this->service->deleteEmployees($id);
        if ($user) {
            return $this->Json(204, "Successfully deleted");
        }
        return $this->Json(404, "Data not found");
    }

    public function searchExcludes(Request $request)
    {
        $me = auth('api')->user();
        if (!$me->hasAnyPermission(['employees.searchExcludes'])) {
            return $this->Json(403, "Without permission");
        }
        $user = $this->service->getExcludedEmployees($request->all());
        if ($user->count() > 0) {
            return $this->Json(200, "Found data", $user->toArray());
        }
        return $this->Json(404, "Data not found");
    }

    public function restore($id)
    {
        $me = auth('api')->user();
        if (!$me->hasAnyPermission(['employees.restore'])) {
            return $this->Json(403, "Without permission");
        }
        $user = $this->service->restoreEmployees($id);
        if ($user) {
            $user = $this->service->getEmployeesById($id);
            return $this->Json(201, "Successfully restored", $user->toArray());
        }
        return $this->Json(404, "Data not found");
    }

    public function getById($id)
    {

        $me = auth('api')->user();
        if (!$me->hasAnyPermission(['employees.getbyid'])) {
            return $this->Json(403, "Without permission");
        }

        $user = $this->service->getEmployeesById($id);
        if ($user) {
            return $this->Json(200, "Found data", $user->toArray());
        }
        return $this->Json(404, "Data not found");
    }
}
