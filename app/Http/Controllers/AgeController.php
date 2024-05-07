<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Support\HtmlString;

use App\Models\Age;

class AgeController extends Controller
    {

        // 科目の作成フォームを表示
        public function create()
        {
            return view('ages.create');
        }
    
        // 科目をデータベースに保存
        public function store(Request $request)
        {
            $validationData = $request->validate
            (
                [
    
                'name'=>
                [
                    'required', //絶対に入れる
                    'string', //文字列であるべき
                    'max:50', //50文字まで
                    Rule::Unique('ages') //を一つにする(モデルの調整必要)
                    ->where(function ($query) //クエリを参照
                    {
                        return $query->where('user_id', auth()->id())->whereNull('deleted_at');
                        //user idが現在ログインしているユーザーと一致している情報のみ→削除されているものは除外です。
                    }),
    
                ],
                ],
                [
                    // カスタムエラーメッセージ
                    'name.required' => '科目の名前は必須です。', 'name.unique' => 'この科目はすでに使用されています。',
                ]
            );
            $ages = new Age;
            $ages->name = $request->name;
            $ages->save(); //保存
    
            return redirect()->route('ages.index')->with('success', '登録完了しました！'); 
    
        }
    
        // 科目の一覧を表示
        public function index()
        {
            $ages = Age::where('user_id', auth()->id())->get();
            
    
            return view('ages.index',['ages'=> $ages]);
        }
    
        // 科目を削除
        public function delete(Age $ages)
        {
            if
            ($ages->books()->exist())
            {
               return  redirect()->route('agess.index')->with('error','関連データが存在する為削除できません！');
            }
    
            else
            $ages->delete();
            return redirect()->route('ages.index')->with('success', '削除しました！');
        }
    
        // 科目の編集フォームを表示
        public function edit(Age $ages)
        {
            return view('ages.edit',['ages'=> $ages]);
        }
    
        //科目のアップデート
        public function update(Request $request, Age $ages)
        {
            $validationData = $request->validate
            (
                [
                'name'=>
                    [
                    'required', //絶対に入れる
                    'string', //文字列であるべき
                    'max:50', //50文字まで
                    Rule::Unique('ages') //同じ科目を一つにする(モデルの調整必要)
                    ->where(function ($query) //クエリを参照
                        {
                        return $query->where('user_id', auth()->id())->whereNull('deleted_at');
                        //user idが現在ログインしているユーザーと一致している情報のみ→削除されているものは除外です。
                        }),
    
                    ],
                ],
    
                [
                    // カスタムエラーメッセージ
                    'name.required' => '科目の名前は必須です。', 'name.unique' => 'この科目はすでに使用されています。',
                ]
    
            );
            // バリデーションが成功したらカテゴリを更新
            $ages->update($request->all()); //入力されたものをすべて取得
            return redirect()->route('ages.index')->with('success', '科目変更完了しました！');
        }
    }
    


