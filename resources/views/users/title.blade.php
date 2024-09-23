<!DOCTYPE html>
<html>

<head>
    <title>ようこそ！</title>
    <link rel="stylesheet" href="{{ asset('css/sane.css') }}">

</head>

<body>
    <div class="container">
        <div>
            <h1>〇作品登録メモへようこそ！</h1>
        </div>

        <div class="description">
            <h2>・説明</h2>
            <p>このアプリは読みたい本や行きたい博物館、美術館を登録できます。登録した情報を科目や年代ごとに整理できるため体系的な知見を獲得するのに役立ちます。</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- 成功メッセージの表示 -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- 一般的なエラーメッセージの表示 -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="links">
            <div class="left-link">
                <p>※初めての方はこちら</p>
                <a href="{{ route('users.create') }}" class="button-link">登録</a>
            </div>

            <div class="right-link">
                <p>※既に登録している方</p>
                <a href="{{ route('users.loginpage') }}" class="button-link">ログイン</a>
            </div>
        </div>
    </div>
</body>

</html>
