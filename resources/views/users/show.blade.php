<!DOCTYPE html>
<html>

<head>
    <title>プロフィール</title>
    <link rel="stylesheet" href="{{ asset('css/sane.css') }}">
</head>

<body>
    <div class="container">
        <div class="user-details-header">
            <h1>ユーザー詳細</h1>
            <a href="{{ route('users.edit') }}" class="edit-button">編集する</a>
        </div>

        <p>名前: {{ $user->name }}</p>
        <p>メールアドレス: {{ $user->email }}</p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="button-delete ">ログアウト</button>
        </form>

        <div class="info-section">
            <p>※ユーザー名は全角、パスワードは半角英数字で入力してください。</p>
            <a href="{{ route('users.editpass') }}" class="edit-pass-button">パスワードを編集する</a>
        </div>

        <a href="{{ route('home.index') }}">ホームへ戻る</a>

    </div>
</body>

</html>

