<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class User extends Model
{
    use HasFactory, Uuid;

    protected $guarded = ['id'];
    protected $keyType = 'string';
    public $incrementing = false;
    public $table = 'users';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'sex',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'sex' => 'string',
    ];

    public function todos(){
        return $this->hasMany('App\TodoItem');
    }
}
