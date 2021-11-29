<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;
    protected $table = "tbl_orders";
    protected $primary_key = "id_order";
    public $timestamps = false;

    protected $fillable = [
        'id_order',
        'adminuser_id',
        'workunit_id',
        'order_category',
        'order_tm',
        'order_dt',
        'order_deadline'
    ];
}
