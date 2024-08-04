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
        //関数の定義
        $subject = new Subject;
        $subject_name =$request->input('subject_name');
        //文字整理
       
        $subject_name = trim($subject_name);
        $subject_name = mb_convert_kana($subject_name, 'ASKV', 'UTF-8');

        if(mb_strlen($subject_name, 'UTF-8') > 16)
        {
            return redirect()->route('subjects.index')->with('error',"最大入力文字は16文字までです。");
        }

        if (Subject::where('subject_Name', $subject_name)->exists()) 
        {
            return redirect()->route('subjects.index')->with('error',"この科目名は既に登録されています。");
        }

        //保存する
        $subject->subject_Name =$subject_name;
        $subject->save(); //保存

        return redirect()->route('subjects.create')->with('success', '作品が登録されました');
    
    }
    
    public function index()
    {
        $subjects=Subject::where('subject_Name', '!=', '削除済み')->where('subject_Name', '!=', '科目を選択してください。')->get();
        return view('subjects.index',compact('subjects'));
    }

    public function delete(Request $request, $subject_ID)
    {
        $subject = Subject::where('subject_ID', $subject_ID)->first();
        
        if ($subject) 
        {
            $subject->subject_Name = '削除済み';
            $subject->update();
            
            return redirect()->route('subjects.index')->with('success', 'データを削除しました。');
        }
        return redirect()->route('subjects.index')->with('error', 'データが見つかりません。');
    }


}
