<?php

namespace App\Services\Implementation;

use App\Models\Employees;
use App\Services\Interfaces\IEmployeesService;

class EmployeesService implements IEmployeesService
{
    private $model;

    public function __construct(Employees $employees)
    {
        $this->model = $employees;
    }

    public function createEmployees(array $employees)
    {
        return $this->model->create($employees);
    }

    public function fetchEmployees(array $filter)
    {
        $per_page = empty($filter["per_page"]) ?  null : $filter["per_page"];
        $query = $this->model->newQuery();
        $query->filter($filter);
        $employees = $query->paginate($per_page);
        return $employees;
    } 

    public function getEmployeesById(int $id)
    {
        $employees = $this->model->find($id);
        if ($employees) {
            return $employees;
        }
        return false;
    }

    public function editEmployees(array $employees, int $id)
    {
        $data = $this->model->find($id);
        if ($data) {
            $data->fill($employees)->save();
            return $data;
        }
        return null;
    } 

    public function deleteEmployees(int $id)
    {
        $data = $this->model->find($id);
        if ($data) {
            return $data->delete();
        }
        return false;
    }

    public function getExcludedEmployees(array $filter)
    {
        $per_page = empty($filter["per_page"]) ?  null : $filter["per_page"];
        $query = $this->model->newQuery();
        $query->whereNotNull('deleted_at');
        $query->withTrashed();
        $query->filter($filter);
        $employees = $query->paginate($per_page);
        return $employees;
    }

    public function restoreEmployees(int $id)
    {
        $employees = $this->model->withTrashed()->find($id);
        if ($employees) {
            return $employees->restore();
        }
        return false;
    }
}
