<!DOCTYPE html>
<html>

<head>
    <title>ユーザー編集</title>
    <link rel="stylesheet" href="{{ asset('css/sane.css') }}">
</head>

<body>
    <div class="container">
        <div>
            <h1>〇ユーザー編集</h1>
        </div>
        <form action="{{ route('users.update') }}" method="POST">
            @csrf
            @method('patch')
            
            <!-- 他のフォームフィールド -->
            <div class="description">
                <div class = "form">
                    <div>
                    <label>・ユーザー名</label><br>
                    <input type="text" name="user_name" maxlength="15" value="{{old("user_name" , $user->name) }}" ><br>
                </div>
                <div>
                <label>・メールアドレス</label><br>
                <input type="text" name="e-mail" maxlength="15" value="{{old("e-mail" , $user->email) }}" ><br>
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
            </div>
        </form>
    </div>
</body>
</html>