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
        //変数$countryを定義。
        $country = new Country;
        //入力した名前を$country_nameとして定義する。
        $country_name = $request->input('country_name');
        //空白があった場合、空白を削除するし全角に自動変換する
        $country_name = trim($country_name);
        $country_name = mb_convert_kana($country_name, 'ASKV', 'UTF-8');

        //〇バリデーション
        //文字数を15文字までにする。
        if(mb_strlen($country_name, 'UTF-8') > 15)
        {
          return back()->withErrors(['name' => '最大入力文字は15文字までです。']);
        }
        //既に登録している場合
        if (Country::where('country_Name', $country_name)->exists()) 
        {
            return back()->withErrors(['name' => 'この地域は既に登録されています。']);
        }
        //記号と数字を制限する。
        if (preg_match('/[^一-龯ぁ-んァ-ヶーａ-ｚＡ-Ｚ]/u', $country_name))
        {
            return back()->withErrors(['name' => '記号や数字は使用できません。']);
        }

        $country ->country_Name = $country_name;
        $country->user_id = auth()->id();//ログイン中のユーザーにuser_idを定義定義
        $country->save(); //保存

        return redirect()->route('countries.create')->with('success', '登録完了しました！'); 
    }

    // 科目の一覧を表示
    public function index()
    {
        $user_id = auth()->id();//user_idをログイン中のユーザーに定義
        //表示する内容
        $countries=Country::where('user_id', $user_id)//userを限定
        ->where('country_Name', '!=', '削除済み')//名前が削除済みのものを除く
        ->where('country_Name','!=','地域を選択してください。')//名前が年代を選択してくださいと書いてあるものを除く
        ->simplePaginate(5);

        return view('countries.index',compact('countries'));
    }

    public function delete(Request $request, $country_ID)
    {
        //$country_IDが一致しているものをしらべる
        $country = Country::where('country_ID', $country_ID)->first();
        if ($country) 
        {
            $country->country_Name = '削除済み';//名前を削除済みに変更する
            $country->update();//保存

            return redirect()->route('countries.index')->with('success', 'データを削除しました。');
        }
        return redirect()->route('countries.index')->with('error', 'データが見つかりません。');
    }

    public function edit(Country $country)
    {
        //ページへ遷移
        return view ('countries.edit' , compact('country'));
    }

    public function update(Request $request,Country $country)
    {
        //編集（保存とコードは同意）
        $country_name =$request->input('country_name');
        $country->country_Name =$country_name;
        $country_name = trim($country_name);
        $country_name = mb_convert_kana($country_name, 'ASKV', 'UTF-8');

        //〇バリデーション
        //文字数を15文字までにする。
        if(mb_strlen($country_name, 'UTF-8') > 15)
        {
          return back()->withErrors(['name' => '最大入力文字は15文字までです。']);
        }
        //既に登録している場合
        if (Country::where('country_Name', $country_name)->exists()) 
        {
            return back()->withErrors(['name' => 'この地域は既に登録されています。']);
        }
        //記号と数字を制限する。
        if (preg_match('/[^一-龯ぁ-んァ-ヶーａ-ｚＡ-Ｚ]/u', $country_name))
        {
            return back()->withErrors(['name' => '記号や数字は使用できません。']);
        }

        $country ->country_Name = $country_name;
        $country->user_id = auth()->id();//ログイン中のユーザーにuser_idを定義定義
        $country->save();

        return redirect()->route('countries.index')->with('success', '作品が更新されました');

    }
}


