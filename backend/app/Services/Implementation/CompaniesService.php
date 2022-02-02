<?php

namespace App\Services\Implementation;

use App\Models\Companies;
use App\Services\Interfaces\ICompaniesService;

class CompaniesService implements ICompaniesService
{
    private $model;

    public function __construct(Companies $Companies)
    {
        $this->model = $Companies;
    }

    public function createCompanies(array $companies)
    {
        return $this->model->create($companies);
    }

    public function fetchCompanies(array $filter)
    {
        $per_page = empty($filter["per_page"]) ?  null : $filter["per_page"];
        $query = $this->model->newQuery();
        $query->filter($filter);
        $companies = $query->paginate($per_page);
        return $companies;
    } 

    public function getCompaniesById(int $id)
    {
        $companies = $this->model->find($id);
        if ($companies) {
            return $companies;
        }
        return false;
    }

    public function editCompanies(array $companies, int $id)
    {
        $data = $this->model->find($id);
        if ($data) {
            $data->fill($companies)->save();
            return $data;
        }
        return null;
    } 

    public function deleteCompanies(int $id)
    {
        $data = $this->model->find($id);
        if ($data) {
            return $data->delete();
        }
        return false;
    }

    public function getExcludedCompanies(array $filter)
    {
        $per_page = empty($filter["per_page"]) ?  null : $filter["per_page"];
        $query = $this->model->newQuery();
        $query->whereNotNull('deleted_at');
        $query->withTrashed();
        $query->filter($filter);
        $companies = $query->paginate($per_page);
        return $companies;
    }

    public function restoreCompanies(int $id)
    {
        $companies = $this->model->withTrashed()->find($id);
        if ($companies) {
            return $companies->restore();
        }
        return false;
    }
}
