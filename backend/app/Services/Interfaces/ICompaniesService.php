<?php

namespace App\Services\Interfaces;

interface ICompaniesService
{
    public function createCompanies(array $Companies);
    public function fetchCompanies(array $filter);
    public function getCompaniesById(int $id);
    public function editCompanies(array $Companies, int $id); 
    public function deleteCompanies(int $id);
    public function getExcludedCompanies(array $filter);
    public function restoreCompanies(int $id);
}
