<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail; 
use App\Mail\TestMail; 
use Illuminate\Http\Request;

class MailTestController extends Controller
{
        //〇ユーザーパスワード変更を再依頼ページ

    public function send()
    {
        $data = [
            'title' => 'こんにちは！',
            'message' => 'Laravelからのテストメールです。'
        ];

        Mail::to('memoapp75@gmail.com')->send(new TestMail($data));

        return "メール送信完了！";
    }
}