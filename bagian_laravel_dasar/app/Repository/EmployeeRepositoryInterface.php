<?php

namespace App\Repository;

use Illuminate\Support\Collection;

/**
 * Interface EmployeeRepositoryInterface
 * @author Herlandro T. <herlandrotri@gmail.com>
 */
interface EmployeeRepositoryInterface extends EloquentRepositoryInterface
{
    public function getListCompany($limit, $search = null,$search_id=null,$page=null): Collection;
}
