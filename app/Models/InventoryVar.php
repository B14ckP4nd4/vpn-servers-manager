<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryVar extends Model
{
    use HasFactory;
    protected $table = 'inventory_vars';
    protected $fillable = ['name','inventory_id','val'];

    /**
     * determine inventory relation
     * @return BelongsTo
     */
    public function inventory()
    {
        return $this->belongsTo(Inventory::class,'inventory_id','id');
    }
}
