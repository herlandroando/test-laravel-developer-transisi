<?php

namespace App\Repository\Eloquent;

use App\Models\Employee;
use App\Repository\EmployeeRepositoryInterface;
use App\Repository\QueryImplementorTrait;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class EmployeeRepository
 * @author Herlandro T. <herlandrotri@gmail.com>
 */
class EmployeeRepository extends EloquentRepository implements EmployeeRepositoryInterface
{
    use QueryImplementorTrait;

    /**
     * Model repository
     *
     * @var \App\Models\Employee
     */
    protected $model;

    protected $query_config = [
        "nama" => ["column" => "name"],
        "email" => ["column" => "email"],
        "sort" => ["nama" => "name", "email" => "email"]
    ];

    /**
     * EmployeeRepository constructor
     *
     * @param \App\Models\Employee $model
     */
    public function __construct(Employee $model)
    {
        $this->model = $model;
    }

    public function getListCompany($limit = 7, $search = null, $id = null, $page = null): Collection
    {
        $query = DB::table("companies");
        if (!empty($search)) {
            $query = $query->where("name", "like", "%{$search}%");
        }
        if (!empty($id)) {
            $query = $query->where("id", "=", $id);
        }
        return $query->skip($limit * ($page - 1))->limit($limit)->orderBy("name", "asc")->get();
    }
}
