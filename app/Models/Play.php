<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Play extends Model
{
    use HasFactory;
    protected $table = 'plays';
    protected $fillable = [
        'inventory_id',
        'playbook_id',
        'ok',
        'changed',
        'unreachable',
        'failed',
        'skipped',
        'rescued',
        'ignored',
        'log_file',
        'is_running',
        'run_at',
        'completed_at',
    ];
    protected $guarded = ['id'];



    public function playbook()
    {
        return $this->belongsTo(PlayBooks::class, 'playbook_id','id');
    }


    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id','id');
    }

    public function scopePending($query)
    {
        return $query->where([
            ['run_at','=',null],
            ['is_running','=',0],
            ['completed_at','=', null],
        ]);
    }

}
