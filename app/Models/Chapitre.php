<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapitre extends Model
{
    use HasFactory;

    protected $fillable = [
        'matiere_id',
        'nom',
        'objectif',
        'description',
    ];

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }
}
