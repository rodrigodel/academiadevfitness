<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    /**
     * Atributos que podem ser preenchidos em massa.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'cpf',
        'phone',
        'date_of_birth',
        'gender',
    ];

    /**
     * Relacionamento: Um membro pode ter muitos pagamentos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Um membro pode ter muitos planos.
     */
    public function plans()
    {
        return $this->hasMany(Plan::class);
    }
}

