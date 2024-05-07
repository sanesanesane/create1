<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Support\HtmlString;

use App\Models\Country;


class CountryController extends Controller
{

    // 科目の作成フォームを表示
    public function create()
    {
        return view('countries.create');
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
                Rule::Unique('countries') //を一つにする(モデルの調整必要)
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
        $countrys = new Country;
        $countrys->name = $request->name;
        $countrys->save(); //保存

        return redirect()->route('countries.index')->with('success', '登録完了しました！'); 

    }

    // 科目の一覧を表示
    public function index()
    {
        $countries = Country::where('user_id', auth()->id())->get();
        

        return view('countries.index',['countries'=> $countries]);
    }

    // 科目を削除
    public function delete(Country $countries)
    {
        if
        ($countries->books()->exist())
        {
           return  redirect()->route('countries.index')->with('error','関連データが存在する為削除できません！');
        }

        else
        $countries->delete();
        return redirect()->route('countries.index')->with('success', '削除しました！');
    }

    // 科目の編集フォームを表示
    public function edit(Country $countries)
    {
        return view('countries.edit',['countries'=> $countries]);
    }

    //科目のアップデート
    public function update(Request $request, Country $countries)
    {
        $validationData = $request->validate
        (
            [
            'name'=>
                [
                'required', //絶対に入れる
                'string', //文字列であるべき
                'max:50', //50文字まで
                Rule::Unique('countries') //同じ科目を一つにする(モデルの調整必要)
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
        $countries->update($request->all()); //入力されたものをすべて取得
        return redirect()->route('countries.index')->with('success', '科目変更完了しました！');
    }
}


