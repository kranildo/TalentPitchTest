<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Companies\CompaniesCreateRequest;
use App\Http\Requests\v1\Companies\CompaniesEditRequest;
use App\Services\Implementation\CompaniesService;
use Illuminate\Http\Request;

/**
 * @group Companies
 * Companies Management APIs
 */
class CompaniesCtrl extends Controller
{
    private $service;

    public function __construct(CompaniesService $Service)
    {
        $this->service = $Service;
    }
    public function create(CompaniesCreateRequest $request)
    {
        $me = auth('api')->user();
        if (!$me->hasAnyPermission(['companies.create'])) {
            return $this->Json(403, "Without permission");
        }
        $user = $this->service->createCompanies($request->all());
        if ($user) {
            return $this->Json(201, "Saved successfully", $user->toArray());
        }
        return $this->Json(304, "Error saving");
    }
    public function search(Request $request)
    {
        $me = auth('api')->user();
        if (!$me->hasAnyPermission(['companies.search'])) {
            return $this->Json(403, "Without permission");
        }
        $user = $this->service->fetchCompanies($request->all());
        if ($user->count() > 0) {
            return $this->Json(200, "Found data", $user->toArray());
        }
        return $this->Json(404, "Data not found");
    }

    public function edit(CompaniesEditRequest $request, $id)
    {
        $me = auth('api')->user();
        if (!$me->hasAnyPermission(['companies.edit'])) {
            return $this->Json(403, "Without permission");
        }
        $user = $this->service->editCompanies($request->all(), $id);
        if ($user) {
            return $this->Json(202, "Successfully updated", $user->toArray());
        }
        return $this->Json(404, "Data not found");
    }

    public function exclude($id)
    {
        $me = auth('api')->user();
        if (!$me->hasAnyPermission(['companies.exclude'])) {
            return $this->Json(403, "Without permission");
        }
        $user = $this->service->deleteCompanies($id);
        if ($user) {
            return $this->Json(204, "Successfully deleted");
        }
        return $this->Json(404, "Data not found");
    }

    public function searchExcludes(Request $request)
    {
        $me = auth('api')->user();
        if (!$me->hasAnyPermission(['companies.searchExcludes'])) {
            return $this->Json(403, "Without permission");
        }
        $user = $this->service->getExcludedCompanies($request->all());
        if ($user->count() > 0) {
            return $this->Json(200, "Found data", $user->toArray());
        }
        return $this->Json(404, "Data not found");
    }

    public function restore($id)
    {
        $me = auth('api')->user();
        if (!$me->hasAnyPermission(['companies.restore'])) {
            return $this->Json(403, "Without permission");
        }
        $user = $this->service->restoreCompanies($id);
        if ($user) {
            $user = $this->service->getCompaniesById($id);
            return $this->Json(201, "Successfully restored", $user->toArray());
        }
        return $this->Json(404, "Data not found");
    }

    public function getById($id)
    {
        $me = auth('api')->user();
        if (!$me->hasAnyPermission(['companies.getbyid'])) {
            return $this->Json(403, "Without permission");
        }

        $user = $this->service->getCompaniesById($id);
        if ($user) {
            return $this->Json(200, "Found data", $user->toArray());
        }
        return $this->Json(404, "Data not found");
    }
}
