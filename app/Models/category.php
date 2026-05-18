<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    // protected $table = 'categories';

    protected $fillable = [
        'user_id',   // se le categorie sono per utente
        'name',
        'color',     // se usi un colore per il badge
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'category_id');
    }
}
