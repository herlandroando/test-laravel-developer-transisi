<?php

namespace App\Repository;


/**
 * Interface CompanyRepositoryInterface
 * @author Herlandro T. <herlandrotri@gmail.com>
 */
interface CompanyRepositoryInterface extends EloquentRepositoryInterface
{
    public function storeTempFile($filename): void;
    public function updateFile($id,$filename): void;
}
