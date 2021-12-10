<?php

namespace App\Repository\Eloquent;

use App\Repository\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class EloquentRepository
 * @author Herlandro T. <herlandrotri@gmail.com>
 */
class EloquentRepository implements EloquentRepositoryInterface
{

    /**
     * Model repository
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * EloquentRepository constructor
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieve all model results
     *
     * @param array $columns Columns that want only to be retrieve.
     * @param array $relations Relation that want to be retrieve.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(array $columns = ["*"], array $relations = []): Collection
    {
        if (method_exists($this, "runQuery")) {
            $function = "runQuery";
            return $this->$function($this->model, $columns, $relations);
        } else {
            return $this->model->with($relations)->get($columns);
        }
    }

    /**
     * Retrieve pagination results
     *
     * @param int $per_page Page per pagination.
     * @param array $columns Columns that want only to be retrieve.
     * @param array $relations Relation that want to be retrieve.
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function pagination(int $per_page = 10, array $columns = ["*"], array $relations = []): ?LengthAwarePaginator
    {
        if (method_exists($this, "runQuery")) {
            $function = "runQuery";
            return $this->$function($this->model, $columns, $relations, $per_page);
        } else {
            return $this->model->with($relations)->paginate($per_page, $columns);
        }
    }

    /**
     * Finding model by ID
     *
     * @param int|string $id ID that want to be find.
     * @param array $columns Columns that want only to be retrieve.
     * @param array $relations Relation that want to be retrieve.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findById($id, array $columns = ["*"], array $relations = []): Model
    {
        return $this->model->select($columns)->with($relations)->findOrFail($id);
    }

    /**
     * Create a new model and add to database.
     *
     * @param array $attributes Assign attributes to new model.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $attributes): ?Model
    {
        $newModel = $this->model->create($attributes);

        return $newModel->fresh();
    }

    /**
     * Update the exist model by id.
     * @param int|string $id
     * @param array $attributes Assign attributes to model that want to be update.
     * @return boolean
     */
    public function update($id, array $attributes): bool
    {
        $model = $this->findById($id);
        return $model->update($attributes);
    }

    /**
     * Delete the exist model by id.
     *
     * @param int|string $id
     * @return boolean
     */
    public function deleteById($id): bool
    {
        $model = $this->findById($id);
        return $model->delete();
    }

    public function count():int{
        return $this->model->count();
    }
}
