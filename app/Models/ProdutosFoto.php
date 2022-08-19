<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdutosFoto extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'produtos';

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function produto()
    {
        return $this->belongsTo(Produtos::class, 'produto_id');
    }
}
