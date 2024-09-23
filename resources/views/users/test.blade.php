
<!DOCTYPE html>
<html>
<head>
    <title>ログイン</title>
    <link rel="stylesheet" href="{{ asset('css/sane.css') }}">
</head>
<body>
    <div class="container">
    <div>
    <h1>ログイン</h1>
    </div>

    <form method="POST" action="{{ route('users.login') }}">
        @csrf
        <div class="description">
            <div class = "form">
        <div>
            <label for="email">メールアドレス</label><br>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="password">パスワード</label><br>
            <input type="password" id="password" name="password" required>
            @error('password')
                <div>{{ $message }}</div>
            @enderror
        </div>
            </div>
        </div>
        <div class="links">
            <div class="left-link">
                <button class="button-link">ログイン</button>
            </div>
            <div class="right-link">
                <input type="button" class="button-back" value="戻る" onclick= "history.back()">
            </div>
        </div>
    </form>
</body>
</html>
