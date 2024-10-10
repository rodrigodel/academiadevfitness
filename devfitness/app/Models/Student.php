<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * Atributos que podem ser atribuídos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'cpf',
        'phone',
    ];

    /**
     * Especifica o nome da tabela.
     *
     * @var string
     */
    protected $table = 'students';
}
