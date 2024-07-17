<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Work extends Model
{
    use HasFactory;

    // Workモデル

    protected $primaryKey = 'work_id';


    protected $fillable = 
    [
        'subject_ID',
        'age_ID',
        'country_ID',
        'museum_ID',
        'work_name',
        'work_artist',
        'work_description'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'subject_ID');//workテーブルの'subject_id'は'subject'のsubject_IDを参照する。
    }

    public function age()
    {
        return $this->belongsTo(Age::class,'age_id','age_ID');
    }

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id','country_ID');
    }

    public function museum()
    {
        return $this->belongsTo(Museum::class,'museum_id','museum_ID');
    }

    
}
