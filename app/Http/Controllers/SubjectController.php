<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Contracts\Validation\Rule;

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
                Rule::unique('subjects') //同じ科目を一つにする(モデルの調整必要)
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

        // 保存ロジック
        return redirect()->route('subjects.index')->with('success', '登録完了しました！'); 

    }

    // 科目の一覧を表示
    public function index()
    {
        // 科目一覧取得ロジック
        return view('subjects.index');
    }

    // 科目を削除
    public function delete($id)
    {
        // 削除ロジック
        return redirect()->route('subjects.index');
    }

    // 科目の編集フォームを表示
    public function edit($id)
    {
        // 編集データ取得ロジック
        return view('subjects.edit');
    }
}
