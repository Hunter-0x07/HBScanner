<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskPoc extends Model
{
    /**
     * 与模型关联的表名
     */
    protected $table = 'task_poc';

    /**
     * 与表关联的主键
     */
    protected $primaryKey = 'id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'task_id', 'poc_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
}
