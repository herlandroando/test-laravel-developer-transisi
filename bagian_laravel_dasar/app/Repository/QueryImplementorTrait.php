<?php

namespace App\Repository;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait QueryImplementorTrait
{
    public function runQuery(Model $model, array $columns = ["*"], array $relations = [], int $per_page = null)
    {
        if (!property_exists($this, "query_config")) {
            throw new Exception("Query configuration (query_config) not defined on repository.");
        }
        $has_pagination = !empty($per_page);

        $query  = collect(request()->only(array_keys($this->query_config)));
        $sort   = $query->only("sort");
        $query  = $query->except("sort");

        if (!empty($query)) {
            $this->handleQuery($model, $query);
        }
        if (!empty($sort)) {
            $model = $this->handleSort($model, $query);
        }

        if ($has_pagination) {
            return $model->with($relations)->paginate($per_page, $columns);
        } else {
            return $model->with($relations)->get($columns);
        }
    }

    public function handleQuery($model, $query)
    {
        foreach ($query as $key => $value) {
            $column = $this->query_config[$key]["column"] ?? $key;
            if (!empty($this->query_config[$key]["relation"])) {
                $relation_table = $this->query_config[$key]["relation"];
                return $model->with([$relation_table => function ($query_relation) use ($column, $value) {
                    $query_relation->where($column, $value);
                }]);
            } else {
                return $model->where($column, $value);
            }
        }
    }

    public function handleSort($model, $sort)
    {
        $sort_option    = explode("!", $sort);
        $available      = array_keys($this->query_config["sort"]);
        if (
            empty($sort_option)
            || count($sort_option) < 2
            || !in_array($sort_option[0], $available)
            || !in_array($sort_option[1], ["asc", "desc"])
        ) {
            return $model;
        }
        list($key, $value) = $sort_option;
        $column = $this->query_config["sort"][$key];
        if (Str::contains($column, '.')) {
            list($relation_table, $column) = explode(".", $column);
        }
        if (!empty($value["relation"])) {
            return $model->with([$relation_table => function ($query_relation) use ($column, $value) {
                $query_relation->orderBy($column, $value);
            }]);
        } else {
            return $model->orderBy($column, $value);
        }
    }
}
