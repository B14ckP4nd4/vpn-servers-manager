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
        'path',
        'is_running',
        'run_at',
        'completed_at',
    ];
    protected $guarded = ['id'];



    public function playbook()
    {
        return $this->belongsTo(PlayBooks::class, 'playbook_id','id');
    }

}