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
                <a href="{{ route('users.edit', $user) }}" class="button-store">編集する</a>
            </div>

            <div>
                <h2>ユーザー名</h2>
                ・{{ $user->name }}</p>
            </div>
            <div>
                <h2>メールアドレス</h2>
                ・{{ $user->email }}</p>
            </div>
        </div>

        <div class="button-container">
            <div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="edit-pass-button">
                        ログアウトをする
                    </button>
                </form>
            </div>

            <div>
                <a href="{{ route('home.index') }}" class="button-back">ホームへ戻る</a>
            </div>
        </div>

</html>
</body>

</html>
