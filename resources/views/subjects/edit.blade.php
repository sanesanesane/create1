<!DOCTYPE html>
<html>

<head>
    <title>科目編集</title>
    <link rel="stylesheet" href="{{ asset('css/sane.css') }}">
</head>

<body>
    <div class="container">
        <div>
            <h1>〇科目編集</h1>
        </div>
        <form action="{{ route('subjects.update', $subject) }}" method="POST">
            @csrf
            @method('patch')
            
            <!-- 他のフォームフィールド -->
            <div class="description">
                <div class = "form-work">
                    <label>・科目</label><br>
                    <input type="text" name="subject_name" maxlength="15" value="{{old("subject_name" , $subject->subject_Name) }}" ><br>
                    @error('name')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
                </div>
            </div>
            <div class="links">
                <div class="left-link">
                    <input type="submit" class="button-store">
                </div>
                <div class="right-link">
                    <a href="{{ route('subjects.index') }}"class="button-back">戻る</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
