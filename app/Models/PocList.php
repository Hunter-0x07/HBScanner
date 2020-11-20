<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PocList extends Model
{
    /**
     * 与模型关联的表名
     */
    protected $table = 'poc_list';

    /**
     * 与表关联的主键
     */
    protected $primaryKey = 'poc_id';
}
