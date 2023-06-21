<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $table = 'series';
    protected $guarded = ['id'];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id','id');
    }

}
