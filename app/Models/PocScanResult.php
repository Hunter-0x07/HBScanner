<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PocScanResult extends Model
{
    protected $table = 'poc_scan_results';
    protected $primaryKey = 'vul_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'poc_id',
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
