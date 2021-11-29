<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RackModel extends Model
{
    use HasFactory;
    protected $table = "tbl_slots_rackings";
    protected $primary_key = "id_slot_racking";
    public $timestamps = false;

    protected $fillable = [
        'id_slot_racking',
        'rack_id',
        'rack_level',
        'rack_pallet_id',
        'rack_pallet_status',
        'rack_tm',
        'rack_dt'

    ];
}
