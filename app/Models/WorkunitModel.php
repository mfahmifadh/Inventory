<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkunitModel extends Model
{
    use HasFactory;
    protected $table = "tbl_workunits";
    protected $primary_key = "id_workunit";
    public $timestamps = false;

    protected $fillable = [
        'id_workunit',
        'workunit_name',
        'status_id'
    ];
}
