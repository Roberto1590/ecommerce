<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contato extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'contato';

    protected $fillable = [
        'user_id',
        'cpf',
        'telefone_comercial',
        'telefone_celular',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
