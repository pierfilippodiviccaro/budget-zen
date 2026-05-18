<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // se non ci sono già:
    protected $fillable = [
        'user_id',
        'category_id',
        'type',
        'amount',
        'description',
        'date',
    ];

    public function category()
    {
        return $this->belongsTo(category::class, 'category_id');
    }
}