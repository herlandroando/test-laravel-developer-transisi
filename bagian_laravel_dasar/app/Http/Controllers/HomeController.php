<?php

namespace App\Http\Controllers;

use App\Repository\CompanyRepositoryInterface;
use App\Repository\EmployeeRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $employeeRepository;
    protected $companyRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository, CompanyRepositoryInterface $companyRepository)
    {
        $this->employeeRepository = $employeeRepository;
        $this->companyRepository = $companyRepository;
    }

    public function index()
    {
        return view("home", [
            "count" => [
                "employees" => $this->employeeRepository->count(),
                "companies" => $this->companyRepository->count()
            ]
        ]);
    }
}
