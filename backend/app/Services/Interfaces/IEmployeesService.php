<?php

namespace App\Services\Interfaces;

interface IEmployeesService
{
    public function createEmployees(array $Employees);
    public function fetchEmployees(array $filter);
    public function getEmployeesById(int $id);
    public function editEmployees(array $Employees, int $id); 
    public function deleteEmployees(int $id);
    public function getExcludedEmployees(array $filter);
    public function restoreEmployees(int $id);
}
