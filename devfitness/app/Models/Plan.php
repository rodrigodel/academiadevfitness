<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'plan_type',
        'start_date',
        'end_date',
        'status',
    ];

    /**
     * Relação com o modelo Member.
     * Um plano pertence a um membro.
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
