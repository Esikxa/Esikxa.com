<?php

namespace App\Repositories;

abstract class Repository
{
    protected $model;

    public function model()
    {
        return $this->model;
    }

    public function get()
    {
        return $this->model->get();
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create($inputs)
    {
        return $this->model->create($inputs);
    }

    public function update($id, $inputs)
    {
        $update = $this->findByUuid($id);
        return $update->fill($inputs)->save();
    }
    public function updateById($id, $inputs)
    {
        $update = $this->find($id);
        $update->fill($inputs)->save();
        return $update;
    }

    public function delete()
    {
        return $this->model->delete();
    }

    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    public function orderBy($prop, $type = null)
    {
        return $this->model->orderBy($prop, $type);
    }
    public function first()
    {
        return $this->model->first();
    }

    public function firstOrNew($id)
    {
        return $this->model->firstOrNew(array('id' => $id));
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findOrFail($id = '')
    {
        return $this->model->findOrFail($id);
    }

    public function findByUuid($uuid, $with = [])
    {
        return $this->model->with($with)->withTrashed()->where('uuid', $uuid)->firstOrFail();
    }

    public function findWith($id, $with = [])
    {
        return $this->model->with($with)->find($id);
    }

    public function findBySlugWith($slug, $with = [])
    {
        return $this->model->with($with)->where('slug', $slug)->first();
    }

    public function findByWith($field, $value, $with = [])
    {
        return $this->model->with($with)->where($field, $value)->first();
    }

    public function findBy($field, $value)
    {
        return $this->model()->where($field, $value)->first();
    }

    public function where($column, $opOrVal, $value = "")
    {
        return $this->model->where($column, $opOrVal, $value);
    }

    public function orWhere($column, $operator, $value)
    {
        return $this->model->orWhere($column, $operator, $value);
    }

    public function orWhereBetween($column, $range)
    {
        return $this->model->orWhereBetween($column, $range);
    }

    public function whereBetween($column, $range)
    {
        return $this->model->whereBetween($column, $range);
    }

    public function whereIn($column, $array)
    {
        return $this->model->whereIn($column, $array);
    }

    public function whereNull($column)
    {
        return $this->model->whereNull($column);
    }

    public function with($with = [])
    {
        return $this->model->with($with);
    }

    public function withTrashed()
    {
        return $this->model->withTrashed();
    }

    public function allWith($with = false, $orderBy = false)
    {
        $model = $this->model;
        if ($with) {
            $model = $model->with($with);
        }
        if ($orderBy) {
            $model = $model->orderBy($orderBy);
        }
        return $model->get();
    }

    public function paginate($limit = 10)
    {
        return $this->model->paginate($limit);
    }

    public function count()
    {
        return $this->model->count();
    }

    /**
     * Checks if the given key exists in given config array and returns the val if exists
     * @param array $config list of config values
     * @param string $key the key that may exist in config array
     * @param string $default default value
     * @return string
     */
    protected function getConfigValue($config, $key, $default = "")
    {
        $value = $default;
        if (isset($config[$key])) {
            $value = $config[$key];
        }
        return $value;
    }
}
