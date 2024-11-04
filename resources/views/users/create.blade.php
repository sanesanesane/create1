<!DOCTYPE html>
<html>

<head>
    <title>ユーザー登録</title>
    <link rel="stylesheet" href="{{ asset('css/sane.css') }}">
</head>

<body>
    <div class="container">
        <div>
            <h1>〇ユーザー登録</h1>
        </div>

        <form method="POST" action="{{ route('users.register') }}">
            @csrf
            <div class="description">
                <div class = "form">
                    <div>
                        <label for="name">名前</label><br>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="email">メールアドレス</label><br>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="password">パスワード</label><br>
                        <input type="password" id="password" name="password" required>
                        @error('password')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="password_confirmation">パスワード確認</label><br>
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                        @error('password')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <p>※ユーザー名は全角、パスワードは半角英数字で入力してください。</p>
                    </div>
                </div>
                <div class="links">
                    <div class="left-link">
                        <button class="button-link">登録</button>
                    </div>
                    <div class="right-link">
                        <input type="button" class="button-back" value="戻る" onclick= "history.back()">
                    </div>
                </div>
        </form>
    </div>

</body>

</html>
