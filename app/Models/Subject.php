<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory;

    //テーブルの名前と関連。
    protected $table = 'subjects';
    protected $fillable = ['subject_ID', 'subject_Name'];
    protected $primaryKey = 'subject_ID';
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
