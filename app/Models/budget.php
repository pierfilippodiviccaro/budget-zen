<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Budget.php
class Budget extends Model
{
protected $fillable = [
    'user_id',
    'category_id',
    'month',
    'year',
    'amount',
];

protected $casts = [
    'month' => 'integer',
    'year'  => 'integer',
    'amount' => 'decimal:2',
];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}