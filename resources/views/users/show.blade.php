<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール</title>
</head>
<body>
    <h1>プロフィールページ</h1>

    <p>名前: {{ $user->name }}</p>
    <p>メールアドレス: {{ $user->email }}</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">ログアウト</button>
    </form>

   
</body>
</html>
