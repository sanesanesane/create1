<!DOCTYPE html>
<html>

<head>
    <title>プロフィール</title>
    <link rel="stylesheet" href="{{ asset('css/sane.css') }}">
</head>

<body>
    <div class="container">
        <div class="description">
        <div class="user-details-header">
            <h1>〇ユーザー詳細</h1>
            <a href="{{ route('users.edit',$user) }}" class="edit-button">編集する</a>
        </div>

        <p>ユーザー名<br>
             ・{{ $user->name }}</p>
        <p>メールアドレス<br>
             ・{{ $user->email }}</p>
    </div>

    <div> 
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="background: none; border: none; color: red; text-decoration: underline; cursor: pointer;">
                ログアウトをする
            </button>
        </form>
    </div>
    
        <div class="info-section">
            <p>※パスワードを忘れてしまった場合はこちら。</p>
            <a href="{{ route('users.editpass',$user) }}" class="edit-pass-button">パスワードを編集する</a>
        </div>

        <a href="{{ route('home.index') }}">ホームへ戻る</a>

    </div>
</body>

</html>

