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
        $subjects = Subject::where('subject_Name', '!=', '削除済み')->get();
        $ages = Age::where('age_Name', '!=', '削除済み')->get();
        $museums = Museum::all();
        $countries = Country::where('country_Name', '!=', '削除済み')->get();
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

        $work_name = $request->input('work_name');
        $work_name = trim($work_name);
        $work_name = mb_convert_kana($work_name, 'ASKV', 'UTF-8');//全角に変換

        if(mb_strlen($work_name, 'UTF-8') > 30)
        {
            return back()->withErrors(['name' => '最大入力文字は30文字までです。']);
        }

        if (preg_match('/[^\x{3000}-\x{FF9F}]/u', $work_name)) 
        {
            return back()->withErrors(['name' => '全角文字のみ使用してください。']);
        }

        if (preg_match('/[^一-龯ぁ-んァ-ヶーａ-ｚＡ-Ｚ]/u', $work_name))
        {
            return back()->withErrors(['name' => '記号や数字は使用できません。']);
        }

        if (Work::where('work_name', $work_name)->exists()) 
        {
            return redirect()->route('works.create')->with('error',"この作品は既に登録されています。");
        }

        if(mb_strlen($work->work_artist, 'UTF-8') > 20)
        {
            return back()->withErrors(['artist' => '最大入力文字は20文字までです。']);
        }

        if (preg_match('/[^\x{3000}-\x{FF9F}]/u', $work->work_artist)) 
        {
            return back()->withErrors(['artist' => '全角文字のみ使用してください。']);
        }

        if (preg_match('/[^一-龯ぁ-んァ-ヶーａ-ｚＡ-Ｚ]/u', $work->work_artist))
        {
            return back()->withErrors(['artist' => '記号や数字は使用できません。']);
        }

        $work_description = $request->input('work_description');
        $work_description = trim($work_description);
        $work_description = mb_convert_kana($work_description, 'ASKV', 'UTF-8');//全角に変換

        if(mb_strlen($work_description, 'UTF-8') > 400)
        {
            return back()->withErrors(['description' => '最大入力文字は400文字までです']);
        }

        if (preg_match('/[^\x{3000}-\x{FF9F}]/u', $work_description)) 
        {
            return back()->withErrors(['description' => '全角文字のみ使用してください。']);
        }

        if (preg_match('/[^一-龯ぁ-んァ-ヶーａ-ｚＡ-Ｚ]/u', $work_description))
        {
            return back()->withErrors(['description' => '記号や数字は使用できません。']);
        }


        $work->work_description = $work_description;
        
        $work->work_name = $work_name;
        $work->user_id = auth()->id();

        if ($request->input('subject_id') === null || $request->input('subject_id') === '') {
            return back()->withErrors(['subject_id' => '科目を必ず選択してください。']);
        }

        if ($request->input('age_id') === null || $request->input('age_id') === '') {
            return back()->withErrors(['age_id' => '年代を必ず選択してください。']);
        }

        if ($request->input('country_id') === null || $request->input('country_id') === '') {
            return back()->withErrors(['country_id' => '地域を必ず選択してください。']);
        }

        if ($request->input('museum_id') === null || $request->input('museum_id') === '') {
            return back()->withErrors(['museum_id' => '科目を必ず選択してください。']);
        }

        $work->save(); //保存

        // 保存後のリダイレクトや、保存成功メッセージの表示などを行います。
        return redirect()->route('works.index')->with('success', '作品が登録されました');
    }

    public function index(Request $request)
    {
        $user_id = auth()->id(); 

        $query = Work::with('subject')
                     ->where('work_name', '!=', '削除済み')
                     ->where('user_id', $user_id);
    
        $search = $request->input('search');
        $search = trim($search);
    
        if ($search) {
            $query->where(function($q) use ($search)
             {
                // 内部クエリを作成
                $q->where('work_name', 'LIKE', "%$search%")
                  ->orWhere('work_artist', 'LIKE', "%$search%");
            });
        }
    
        $works = $query->paginate(10);
        return view('works.index', compact('works'));
    }
    

    public function show($work)
    {
        $work = Work::findOrFail($work); // モデルが見つからない場合はエラーを返す
        return view('works.show', compact('work'));
    }

    public function edit(Work $work)
    {
        $subjects = Subject::all();
        $ages = Age::all();
        $museums = Museum::all();
        $countries = Country::all();
        return view('works.edit',compact('work','subjects','ages','museums','countries'));
    }
    
    public function update(Request $request,Work $work)
    {
        $work -> subject_ID = $request->input('subject_id');
        $work -> age_ID = $request->input('age_id');
        $work -> country_ID = $request->input('country_id');
        $work -> museum_ID = $request->input('museum_id');
        $work->work_name = $request->input('work_name');
        $work->work_artist = $request->input('author_name'); 
        $work->work_description = $request->input('work_description'); 
        $work->update();

        return redirect()->route('works.index')->with('success', '作品が更新されました');
    }

    public function delete(Request $request, $work_id)
    {
        $work = Work::where('work_id', $work_id)->first();

        if($work)
        {
            $work->work_name = '削除済み';
            $work->update();

            return redirect()->route('works.index')->with('success', 'データを削除しました。');
        }
        return redirect()->route('works.index')->with('error', 'データが見つかりません。');
    }
    
}
