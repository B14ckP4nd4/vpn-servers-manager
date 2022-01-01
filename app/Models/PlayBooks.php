<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlayBooks extends Model
{
    use HasFactory;
    protected $fillable = ['name','path','url','last_updated_at'];
    protected $guarded = ['id'];
    protected $table = 'playbooks';



    /**
     * determine play relation
     * @return HasMany
     */
    public function plays()
    {
        return $this->hasMany(Play::class, 'playbook_id', 'id');
    }
}
