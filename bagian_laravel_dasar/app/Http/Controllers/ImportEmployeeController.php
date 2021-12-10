<?php

namespace App\Http\Controllers;

use App\Imports\EmployeeImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Validators\ValidationException;

class ImportEmployeeController extends Controller
{
    public function index()
    {
        return view("employees.import.index");
    }

    public function store(Request $request)
    {
        $request->validate([
            "import_file" => ["required", "file", "max:2048", "mimes:xlsx,csv"]
        ]);
        $import = new EmployeeImport();
        try {
            $import->import($request->file("import_file"));
        } catch (ValidationException $th) {
            $failures = $th->failures();
            return back()->with("message", "Error on import!")->with("status", "danger")->with("errors", $failures);
        }
        return back()->with("message", "Success import!")->back()->with("status", "success");
    }
}
