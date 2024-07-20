<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Support\HtmlString;


class SubjectController extends Controller
{
    // 科目の作成フォームを表示
    public function create()
    {
        return view('subjects.create');
    }

    // 科目をデータベースに保存
    public function store(Request $request)
    {
    
        $subject = new Subject;
        $subject ->subject_Name = $request->input('subject_name');
        $subject = trim($request->input('subject_name'));
        $subject = mb_convert_kana($request->input('subject_name'), 'ASKV', 'UTF-8');
        $subject = mb_strlen($request->input('subject_name'), 'UTF-8');
        if($subject > 32)
        {
            return "最大入力文字は16文字までです。";
        }
        if(in_array($request->input('subject_name'),$subject, true))
        {
            return "既に登録されています。";
        }

        $subject->save(); //保存

        return redirect()->route('subjects.create')->with('success', '作品が登録されました');
    
    }
    
    public function index()
    {
        $subjects=Subject::all();
        return view('subjects.index',compact('subjects'));
    }


}
