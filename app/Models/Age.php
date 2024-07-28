<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Age extends Model
{
    use HasFactory;

    protected $table = 'ages';

    protected $fillable = ['age_ID', 'age_Name'];
    
    protected $primaryKey = 'age_ID';

    public $incrementing = true; // 主キーが自動増分されることを指定
    
    protected $keyType = 'int'; // 主キーの型を指定

    public function books()
    {
    return $this->belongsTo(Book::class);
    }

    public function works()
    {
        return $this->hasMany(Work::class);
    }

    
}
