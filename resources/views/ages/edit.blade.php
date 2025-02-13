<!DOCTYPE html>
<html>

<head>
    <title>年代編集</title>
    <link rel="stylesheet" href="{{ asset('css/sane.css') }}">
</head>

<body>
    <div class="container">
        <div>
            <h1>〇年代編集</h1>
        </div>
        <form action="{{ route('ages.update', $age) }}" method="POST">
            @csrf
            @method('patch')
            
            <!-- 他のフォームフィールド -->
            <div class="description">
                <div class = "form-work">
                    <label>・科目</label><br>
                    <input type="text" name="age_name" maxlength="15" value="{{old("age_name" , $age->age_Name) }}" ><br>
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
                    <a href="{{ route('ages.index') }}"class="button-back">戻る</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
