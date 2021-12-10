<?php

namespace App\Http\Controllers;

use App\Repository\CompanyRepositoryInterface;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    protected $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("companies.index", ["companies" => $this->companyRepository->pagination(5, ["*"])]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        // Session::remove("logo");
        // dd(Session::get("logo"));
        if (Session::has("logo")) {
            $data["filename"] = Session::get("logo");
            $data["url"] = route("companies.show.temp", ["filename" => $data["filename"]]);
        }
        return view("companies.create", $data);
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
            "website" => ["required", "max:255", "url"],
        ]);
        if (!Session::has("logo")) {
            return back()->withInput($request->only(["name", "email", "website"]))->withErrors(["logo" => "Logo has not been uploaded."]);
        }
        $filename = Session::get("logo");
        list(, $extension) = explode(".", $filename);
        $new_filename = \Illuminate\Support\Str::random(5) . now()->timestamp . ".$extension";
        $validated["path_logo"] = "{$new_filename}";
        $model = $this->companyRepository->create($validated);
        Storage::move("temp/{$filename}", "company/{$new_filename}");
        Session::remove("logo");
        return redirect(route('companies.show', ['company' => $model->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($company)
    {
        $model = $this->companyRepository->findById($company);
        return view("companies.show", ["company" => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($company)
    {
        $model = $this->companyRepository->findById($company);
        return view("companies.edit", ["company" => $model]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $company)
    {
        $validated = $request->validate([
            "name" => ["required", "max:255", "string"],
            "email" => ["required", "max:255", "email"],
            "website" => ["required", "max:255", "url"],
        ]);
        $this->companyRepository->update($company, $validated);
        return back()->with(["message" => "Success update!"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($company)
    {
        // dd($company);
        $this->companyRepository->deleteById($company);
        return back();
    }


    public function tempUpload(Request $request)
    {
        $base64 = $request->input("logo");
        return response()->json($this->handleFile($base64, "companies.show.temp", true));
    }
    public function upload(Request $request, $company)
    {
        $base64 = $request->input("logo");
        return response()->json($this->handleFile($base64, "companies.show.file", false, $company));
    }

    public function getTempFile($filename)
    {
        if (Storage::exists("temp/{$filename}")) {
            return Storage::download("temp/{$filename}");
        } else {
            return response("File not found");
        }
    }

    public function getFile($company, $filename)
    {
        $this->companyRepository->findById($company);
        if (Storage::exists("company/{$filename}")) {
            return Storage::download("company/{$filename}");
        } else {
            return response("File not found");
        }
    }

    public function reportEmployee($company)
    {
        $company = $this->companyRepository->findById($company, ["*"], ["employees"]);
        $data = [
            "report_created_at" => now(),
            "company" => $company->name,
            "company_id" => $company->id,
            "report_data" => $company->employees,
        ];
        view()->share($data);
        // dd("s");
        return PDF::loadView("reports.main")->setPaper('a4', 'landscape')->stream("download.pdf");
    }

    private function handleFile($base64, $routename, $is_temp = false, $id = null)
    {
        if (empty($base64)) {
            return response()->json(["success" => false, "message" => "File is empty"]);
        }
        try {
            //Explode part of base64 so it will separate metadata on index 0 and data image on index 1.
            $image_parts    = explode(";base64,", $base64);
            //Explode the Mime Part to get image extension. Extension get from index 1.
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type     = $image_type_aux[1];
            //Convert base64 with native function to get image file.
            $file = tmpfile();
            fwrite($file, base64_decode($image_parts[1]));

            //Validate image before store to server.
            //Convert to UploadedFile for validate
            $uploaded_file = new UploadedFile(
                stream_get_meta_data($file)['uri'],
                'image',
                "image/{$image_type}",
                null,
                true
            );
            $validated = Validator::make(["image" => $uploaded_file], [
                "image" => "required|image|max:2048|dimensions:min_width=100,min_height=100|mimes:png"
            ]);

            if ($validated->fails()) {
                fclose($file);
                return ["success" => false, "message" => "File is not valid."];
            }

            fclose($file);
            $image_base64   = base64_decode($image_parts[1]);
            $filename       = \Illuminate\Support\Str::random(5) . now()->timestamp . ".{$image_type}";
            if ($is_temp) {
                Storage::put("temp/{$filename}", $image_base64);
                $this->companyRepository->storeTempFile($filename);
                request()->session()->put("logo", $filename);
                $route = route($routename, ["filename" => $filename]);
            } else {
                Storage::put("company/{$filename}", $image_base64);
                $this->companyRepository->updateFile($id, $filename);
                $route = route($routename, ["filename" => $filename, "company" => $id]);
            }
            return ["success" => true, "message" => "File has been stored.", "value" => ["filename" => $filename, "fileurl" => $route]];
        } catch (\Throwable $th) {
            // @fclose($file);
            throw $th;
            return ["success" => false, "message" => "Something wrong on process file."];
        }
    }
}
