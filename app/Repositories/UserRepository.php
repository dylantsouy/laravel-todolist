<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;

/**
 * Class PermissionRepository
 * @package App\Repositories
 * @version April 22, 2020, 8:09 am UTC
 */

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    public function getUsers()
    {
        return $this->model->all();
    }

    public function getUserByName($name)
    {
        return $this->model->where('name','=',$name)->firstOrFail();
    }

    public function createUser(array $attributes)
    {
        $model = $this->model->newInstance($attributes);

        $model->save();

        return $model;
    }

    public function updateUser($id, array $attributes)
    {
        return $this->model->find($id)->update($attributes);
    }

    public function deleteUser($id)
    {
        return $this->model->find($id)->delete();
    }

}
