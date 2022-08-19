<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categoria';

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function categoriaPai()
    {
        return $this->belongsTo(CategoriasPai::class, 'categoria_pai_id');
    }
}
