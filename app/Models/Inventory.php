<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ['name','path','is_active'];

    /**
     * determine items relation
     * @return HasMany
     */
    public function items(){
        return $this->hasMany(InventoryItem::class);
    }

    /**
     * determine vars relation
     * @return HasMany
     */
    public function vars(){
        return $this->hasMany(InventoryVar::class, 'inventory_id','id');
    }


    /**
     * determine play relation
     * @return HasMany
     */
    public function plays()
    {
        return $this->hasMany(Play::class, 'inventory_id', 'id');
    }
}
