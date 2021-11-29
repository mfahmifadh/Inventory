<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetailModel extends Model
{
    use HasFactory;
    protected $table = "tbl_orders_detail";
    protected $primary_key = "item_code";
    public $timestamps = false;

    protected $fillable = [
        'item_code',
        'order_data_id',
        'item_code',
        'itemcategory_id',
        'item_name',
        'item_weight',
        'item_height',
        'item_qty',
        'description',
        'item_status',
        'item_entry_date',
        'item_exit,date'
    ];
}
