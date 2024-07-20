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
        $subject->save(); //保存

        return redirect()->route('subjects.create')->with('success', '作品が登録されました');
    
    }
    
    public function index()
    {
        $subjects=Subject::all();
        return view('subjects.index',compact('subjects'));
    }


}
