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

        if(mb_strlen($subject_name, 'UTF-8') > 15)
        {
            return back()->withErrors(['name' => '最大入力文字は15文字までです。']);
        }

        if (preg_match('/[^一-龯ぁ-んァ-ヶーａ-ｚＡ-Ｚ]/u', $subject_name))
        {
            return back()->withErrors(['name' => '記号や数字は使用できません。']);
        }

        if (Subject::where('subject_Name', $subject_name)->exists()) 
        {
            return back()->withErrors(['name' => 'その科目名は既に登録されています。']);
        }

        //保存する
        $subject->subject_Name =$subject_name;
        $subject->user_id = auth()->id();
        $subject->save(); //保存

        return redirect()->route('subjects.create')->with('success', '作品が登録されました');
    
    }
    
    public function index()
    {
        {
            $user_id = auth()->id(); 
            $subjects = Subject::where('user_id', $user_id)
                ->where('subject_Name', '!=', '削除済み')
                ->where('subject_Name', '!=', '科目を選択してください。')
                ->simplePaginate(5); 
        
            return view('subjects.index', compact('subjects'));
        }
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

    public function edit(Subject $subject)
    {
        return view ('subjects.edit' , compact('subject'));
    
    }
    
    public function update(Request $request,Subject $subject)
    {
        //require_once("q.php");
        //Log_CsvTxt_Wrt("abc");
        $subject_name =$request->input('subject_name');
        $subject->subject_Name =$subject_name;
        $subject_name = trim($subject_name);
        $subject_name = mb_convert_kana($subject_name, 'ASKV', 'UTF-8');

        $subject->save();

        return redirect()->route('subjects.index')->with('success', '作品が更新されました');


    }

}
