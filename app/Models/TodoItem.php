<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class TodoItem extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $guarded = ['id'];
    protected $keyType = 'string';
    public $incrementing = false;
    public $table = 'todo_items';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'level',
        'deadline',
        'user_name',
        'finish'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'level' => 'int',
        'finish' => 'boolean',
        'user_name' => 'string',
        'deadline' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_name');
    }
}
