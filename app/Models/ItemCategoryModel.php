<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCategoryModel extends Model
{
    use HasFactory;
    protected $table = "tbl_item_category";
    protected $primary_key = "id_item_category";
    public $timestamps = false;

    protected $fillable = [
        'id_item_category',
        'itemcategory_name'
    ];
}
