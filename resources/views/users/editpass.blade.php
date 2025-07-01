<!DOCTYPE html>
<html>

<head>
    <title>パスワード変更</title>
    <link rel="stylesheet" href="{{ asset('css/sane.css') }}">
</head>

<body>
    <div class="container">
        <div>
            <h1>〇パスワード変更</h1>
        </div>
        <form action="{{ route('users.updatepass',$user) }}" method="POST">
            @csrf
            @method('patch')

            <!-- 他のフォームフィールド -->
            <div class="description">
                <div class = "form">
                    <div>
                        <label for="password">・新しいパスワード</label><br>
                        <input type="password" id="password" name="password" ><br>
                        @error('password')
                        <div>{{ $message }}</div>
                    @enderror
                    </div>
                    <div>
                        <label for="password_confirmation">パスワード確認</label><br>
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    <div>
                        <p>パスワードは半角英数字で入力してください。</p>
                    </div>
                </div>

            </div>
            <div class="links">
                <div class="left-link">
                    <input type="submit" class="button-store">
                </div>
                <div class="right-link">

                    <a href="{{ route('home.index') }}"class="button-back">ホームへ戻る</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
