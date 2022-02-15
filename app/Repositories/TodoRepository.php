<?php

namespace App\Repositories;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\TodoItem;
use App\Repositories\BaseRepository;

/**
 * Class PermissionRepository
 * @package App\Repositories
 * @version April 22, 2020, 8:09 am UTC
 */

class TodoRepository extends BaseRepository
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
        return TodoItem::class;
    }

    public function getTodoItems($name, $finish, $pagination = 10)
    {

        $todos = $this->model->orderBy('is_top', 'ASC')->orderBy('deadline', 'ASC');

        if (!empty($name) && empty($finish)) {
            $todos->where('name', 'like', '%' . $name . '%');
        }

        if (empty($name) && !empty($finish)) {
            $todos->where('finish', '=', $finish);
        }

        if (!empty($name) && !empty($finish)) {
            $todos->where('name', 'like', '%' . $name . '%')->where('finish', '=', $finish);
        }

        return $todos->paginate($pagination);
    }


    public function getAllTodoItems()
    {
        return $this->model->all();
    }

    public function createTodoItem(array $attributes)
    {
        $model = $this->model->newInstance($attributes);

        $model->save();

        return $model;
    }

    public function updateTodoItem($id, array $attributes)
    {
        return $this->model->find($id)->update($attributes);
    }

    public function deleteTodoItem($id)
    {
        return $this->model->find($id)->delete();
    }

    public function getDeletedTodoItems()
    {
        return $this->model->onlyTrashed()->get();
    }

    public function restoryDeletedTodoItem($id)
    {
        return $this->model->withTrashed()->find($id)->restore();
    }

    public function getDeadline()
    {
        $FiveDaysLater = Carbon::now()->subDays(-5);
        $tomorrow = Carbon::tomorrow();
        return DB::table('todo_items')->whereDate('deadline',  $tomorrow)
            ->orWhereDate('deadline',  $FiveDaysLater)->get();
    }
}
