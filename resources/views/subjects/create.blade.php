<!DOCTYPE html>
<html>

<head>
    <title>科目登録</title>
    <link rel="stylesheet" href="{{ asset('css/sane.css') }}">
</head>

<body>
    <div class="container">
        <div>
            <h1>〇科目登録</h1>
        </div>
        <form action="{{ route('subjects.store') }}" method="POST">
            @csrf
            <!-- 他のフォームフィールド -->
            <div class="description">
                <div class = "form-work">
                    <label>・科目</label><br>
                    <input type="text" name="subject_name" maxlength="20" value="" placeholder="科目名" required><br>
                    @error('name')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
                </div>
            </div>
            <div class="links">
                <div class="left-link">
                    <button class="button-store">登録</button>
                </div>
                <div class="right-link">
                    <a href="{{ route('dashboard.menu') }}"class="button-back">戻る</a>  
                </div>
            </div>
        </form>
    </div>
</body>
</html>
