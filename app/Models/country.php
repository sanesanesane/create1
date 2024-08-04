<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    use HasFactory;

    protected $table = 'countries';
    protected $fillable = ['country_ID', 'country_Name'];
    protected $primaryKey = 'country_ID';
    protected $keyType = 'int'; // 主キーの型を指定
    public $incrementing = true; // 主キーが自動増分されることを指定
    
    public function books()
    {
    return $this->belongsTo(Book::class);
    }

    public function works()
    {
        return $this->hasMany(Work::class);
    }

    
}
