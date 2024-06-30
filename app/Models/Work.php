<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Work extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subject_id', 'age_id', 'country_id', 'museum_id'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function age()
    {
        return $this->belongsTo(Age::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function museum()
    {
        return $this->belongsTo(Museum::class);
    }

    
}
