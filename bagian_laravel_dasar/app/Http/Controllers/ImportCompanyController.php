<?php

namespace App\Http\Controllers;

use App\Imports\CompanyImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class ImportCompanyController extends Controller
{
    public function index()
    {
        return view("companies.import.index");
    }

    public function store(Request $request)
    {
        $request->validate([
            "import_file" => ["required", "file", "max:2048", "mimes:xlsx,csv"]
        ]);
        $import = new CompanyImport();
        try {
            $import->import($request->file("import_file"));
        } catch (ValidationException $th) {
            $failures = $th->failures();
            return back()->with("message", "Error on import!")->with("status", "danger")->with("errors", $failures);
        }
        return back()->with("message", "Success import!")->with("status", "success");
    }
}
