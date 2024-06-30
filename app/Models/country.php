<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    use HasFactory;

    protected $table = 'countries';

    public function books()
    {
    return $this->belongsTo(Book::class);
    }

    public function works()
    {
        return $this->hasMany(Work::class);
    }

    
}
