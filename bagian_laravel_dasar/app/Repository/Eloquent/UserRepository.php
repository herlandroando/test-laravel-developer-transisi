<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\QueryImplementorTrait;
use App\Repository\UserRepositoryInterface;

/**
 * Class UserRepository
 * @author Herlandro T. <herlandrotri@gmail.com>
 */
class UserRepository extends EloquentRepository implements UserRepositoryInterface
{
    /**
     * Model repository
     *
     * @var \App\Models\User
     */
    protected $model;

    /**
     * UserRepository constructor
     *
     * @param \App\Models\User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
