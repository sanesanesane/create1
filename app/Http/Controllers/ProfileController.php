<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
class ProfileController extends Controller
{
    public function show()
    {
        $data = [
            'title' => 'プロファイルページ',
            'content' => 'これはプロファイルページです。'
        ];
        return view('profile', $data);
    }
}
