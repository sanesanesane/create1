<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects';
    //テーブルの名前と関連。

    public function books()
    {
    return $this->belongsTo(Book::class);
    }

    public function works()
    {
        return $this->hasMany(Work::class);
    }

    

}
