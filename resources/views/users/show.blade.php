<!DOCTYPE html>
<html>

<head>
    <title>プロフィール</title>
    <link rel="stylesheet" href="{{ asset('css/sane.css') }}">
</head>

<body>
    <div class="container">
        <h1>プロフィールページ</h1>

        <p>名前: {{ $user->name }}</p>
        <p>メールアドレス: {{ $user->email }}</p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="button-delete ">ログアウト</button>
        </form>

    </div>
</body>

</html>
