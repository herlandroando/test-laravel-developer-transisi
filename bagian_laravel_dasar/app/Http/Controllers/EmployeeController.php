<?php

namespace App\Http\Controllers;

use App\Repository\EmployeeRepositoryInterface;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    protected $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("employees.index", ["employees" => $this->employeeRepository->pagination(5, ["*"], ["company"])]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("employees.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => ["required", "max:255", "string"],
            "email" => ["required", "max:255", "email"],
            "company_id" => ["required", "numeric", "exists:companies,id"],
        ]);

        $model = $this->employeeRepository->create($validated);

        return redirect(route('employees.show', ['employee' => $model->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($employee)
    {
        $model = $this->employeeRepository->findById($employee, ["*"], ["company"]);
        return view("employees.show", ["employee" => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($employee)
    {
        $model = $this->employeeRepository->findById($employee, ["*"], ["company"]);
        return view("employees.edit", ["employee" => $model]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $employee)
    {
        $validated = $request->validate([
            "name" => ["required", "max:255", "string"],
            "email" => ["required", "max:255", "email"],
            "company_id" => ["required", "numeric", "exists:companies,id"],
        ]);

        $this->employeeRepository->update($employee, $validated);

        return back()->with(["message" => "Success update!"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($employee)
    {
        $this->employeeRepository->deleteById($employee);
        return back();
    }

    /**
     * Listing company untuk ajax select2
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getListCompany(Request $request)
    {
        $search = $request->query("search");
        $search_id = $request->query("i");
        $page = $request->query("page");
        $companies = $this->employeeRepository->getListCompany(10, $search, $search_id, $page);
        if ($companies->isNotEmpty()) {
            $companies->transform(function ($company) {
                return ["id" => $company->id, "text" => $company->name];
            });
            $more = true;
        } else {
            $more = false;
        }
        return response()->json(["results" => $companies, "pagination" => ["more" => $more]]);
    }
}
