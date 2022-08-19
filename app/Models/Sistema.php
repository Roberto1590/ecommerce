<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sistema extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sistema';
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
