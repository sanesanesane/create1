<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;


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
        $validationData = $request->validate
        (
            [

            'name'=>
            [
                'required', //絶対に入れる
                'string', //文字列であるべき
                'max:50', //50文字まで
                Rule::Unique('subjects') //同じ科目を一つにする(モデルの調整必要)
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
        $subjects = new Subject;
        $subjects->name = $request->name;
        $subjects->save(); //保存

        return redirect()->route('subjects.index')->with('success', '登録完了しました！'); 

    }

    // 科目の一覧を表示
    public function index()
    {
        $subjects = Subject::where('user_id', auth()->id())->get();
        //変数subjectsにSubjectデータを現在認証しているユーザーのみを条件にデータを取得。

        return view('subjects.index',['subjects'=> $subjects]);
    }

    // 科目を削除
    public function delete(Subject $subjects)
    {
        if
        ($subjects->books()->exist())
        {
           return  redirect()->route('subjects.index')->with('error','関連データが存在する為削除できません！');
        }

        else
        $subjects->delete();
        return redirect()->route('subjects.index')->with('success', '削除しました！');
    }

    // 科目の編集フォームを表示
    public function edit(Subject $subjects)
    {
        return view('subjects.edit',['subjects'=> $subjects]);
    }

    //科目のアップデート
    public function update(Request $request, Subject $subjects)
    {
        $validationData = $request->validate
        (
            [
            'name'=>
                [
                'required', //絶対に入れる
                'string', //文字列であるべき
                'max:50', //50文字まで
                Rule::Unique('subjects') //同じ科目を一つにする(モデルの調整必要)
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
        $subjects->update($request->all()); //入力されたものをすべて取得
        return redirect()->route('subjects.index')->with('success', '科目変更完了しました！');
    }
}
