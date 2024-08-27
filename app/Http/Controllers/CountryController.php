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
        $country = new Country;
        $country_name = $request->input('country_name');

        $country_name = trim($country_name);
        $country_name = mb_convert_kana($country_name, 'ASKV', 'UTF-8');

        if(mb_strlen($country_name, 'UTF-8') > 16)
        {
            return redirect()->route('countries.index')->with('error',"最大入力文字は8文字までです。");
        }

        if (Country::where('country_Name', $country_name)->exists()) 
        {
            return redirect()->route('countries.index')->with('error',"この地域は既に登録されています。");
        }


        $country ->country_Name = $country_name;
        $country->user_id = auth()->id();
        $country->save(); 

        return redirect()->route('countries.create')->with('success', '登録完了しました！'); 

    }

    // 科目の一覧を表示
    public function index()
    {
        $user_id = auth()->id();
        $countries=Country::where('user_id', $user_id)
        ->where('country_Name', '!=', '削除済み')
        ->where('country_Name','!=','地域を選択してください。')
        ->get();

        return view('countries.index',compact('countries'));
    }

    public function delete(Request $request, $country_ID)
    {
        $country = Country::where('country_ID', $country_ID)->first();
        
        if ($country) 
        {
            $country->country_Name = '削除済み';
            $country->update();

            return redirect()->route('countries.index')->with('success', 'データを削除しました。');
        }
        return redirect()->route('countries.index')->with('error', 'データが見つかりません。');
    }

}


