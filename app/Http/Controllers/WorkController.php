<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Age;
use App\Models\Museum;
use App\Models\Country;
use App\Models\Work;


class WorkController extends Controller
{
    public function create()
    {
        $subjects = Subject::all();
        $ages = Age::all();
        $museums = Museum::all();
        $countries = Country::all();
        return view('works.create', compact('subjects','ages','museums','countries'));
    }

    public function store(Request $request)

    {
        $work = new Work();
        $work -> subject_ID = $request->input('subject_id');
        $work -> age_ID = $request->input('age_id');
        $work -> country_ID = $request->input('country_id');
        $work -> museum_ID = $request->input('museum_id');
        $work->work_name = $request->input('work_name');
        $work->work_artist = $request->input('author_name'); 
        $work->work_description = $request->input('work_description'); 
        $work->save(); //保存

        // 保存後のリダイレクトや、保存成功メッセージの表示などを行います。
        return redirect()->route('works.create')->with('success', '作品が登録されました');
    }

    public function index()
    {
        $works = Work::all();//DBからデータ全部取得
        
        return view('works.index', compact('works'));
    }
    
    
}
