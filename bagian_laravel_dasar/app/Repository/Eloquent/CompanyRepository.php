<?php

namespace App\Repository\Eloquent;

use App\Models\Company;
use App\Repository\CompanyRepositoryInterface;
use App\Repository\QueryImplementorTrait;
use Illuminate\Support\Facades\DB;

/**
 * Class CompanyRepository
 * @author Herlandro T. <herlandrotri@gmail.com>
 */
class CompanyRepository extends EloquentRepository implements CompanyRepositoryInterface
{
    use QueryImplementorTrait;

    /**
     * Model repository
     *
     * @var \App\Models\Company
     */
    protected $model;

    protected $query_config = [
        "nama" => ["column" => "name"],
        "email" => ["column" => "email"],
        "sort" => ["nama" => "name", "email" => "email"]
    ];

    /**
     * CompanyRepository constructor
     *
     * @param \App\Models\Company $model
     */
    public function __construct(Company $model)
    {
        $this->model = $model;
    }

    public function storeTempFile($filename): void
    {
        DB::table('temp_files')->insert(["filename" => $filename, "created_at" => now()]);
    }

    public function updateFile($id, $filename): void
    {
        $update = $this->model->findOrFail($id);
        $update->path_logo = $filename;
        $update->save();
    }
}
