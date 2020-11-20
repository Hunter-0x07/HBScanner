<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PocScanTask extends Model
{
    protected $table = 'poc_scan_tasks';
    protected $primaryKey = 'task_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'task_name', 'task_target', 'task_status',
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
