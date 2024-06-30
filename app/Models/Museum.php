<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Museum extends Model
{
    use HasFactory;

    protected $table = 'museums';

    public function subjects()
   {
    return $this->hasOne(Subject::class);
   }

public function country()
{
   return $this->hasone(country::class);
}

public function Age()
{
   return $this->hasone(Age::class);
}

public function works()
{
    return $this->hasMany(Work::class);
}



}
