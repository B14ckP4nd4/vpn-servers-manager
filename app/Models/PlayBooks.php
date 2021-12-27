<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayBooks extends Model
{
    use HasFactory;
    protected $fillable = ['name','path','url','last_updated_at'];
    protected $guarded = ['id'];
    protected $table = 'playbooks';
}
