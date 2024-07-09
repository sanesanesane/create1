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
        $country ->country_Name = $request->input('country_name');
        $country->save(); 

        return redirect()->route('countries.create')->with('success', '登録完了しました！'); 

    }

    // 科目の一覧を表示
    public function index()
    {
        

        return view('countries.index',['countries'=> $countries]);
    }

}


