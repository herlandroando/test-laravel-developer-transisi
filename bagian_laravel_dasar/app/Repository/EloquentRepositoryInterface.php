<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface EloquentRepositoryInterface
 * @author Herlandro T. <herlandrotri@gmail.com>
 */
interface EloquentRepositoryInterface
{
    /**
     * Retrieve all model results
     *
     * @param array $columns Columns that want only to be retrieve.
     * @param array $relations Relation that want to be retrieve.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(array $columns = ["*"], array $relations = []): Collection;

    /**
     * Retrieve pagination results
     *
     * @param int $per_page Page per pagination.
     * @param array $columns Columns that want only to be retrieve.
     * @param array $relations Relation that want to be retrieve.
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function pagination(int $per_page = 10, array $columns = ["*"], array $relations = []): ?LengthAwarePaginator;

    /**
     * Finding model by ID
     *
     * @param int|string $id ID that want to be find.
     * @param array $columns Columns that want only to be retrieve.
     * @param array $relations Relation that want to be retrieve.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findById($id, array $columns = ["*"], array $relations = []): Model;

    /**
     * Create a new model and add to database.
     *
     * @param array $attributes Assign attributes to new model.
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $attributes): ?Model;

    /**
     * Update the exist model by id.
     * @param int|string $id
     * @param array $attributes Assign attributes to model that want to be update.
     * @return boolean
     */
    public function update($id, array $attributes): bool;

    /**
     * Delete the exist model by id.
     *
     * @param int|string $id
     * @return boolean
     */
    public function deleteById($id): bool;

    public function count(): int;
}
