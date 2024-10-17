<!DOCTYPE html>
<html>

<head>
    <title>地域編集</title>
    <link rel="stylesheet" href="{{ asset('css/sane.css') }}">
</head>

<body>
    <div class="container">
        <div>
            <h1>〇地域編集</h1>
        </div>
        <form action="{{ route('countries.update', $country) }}" method="POST">
            @csrf
            @method('patch')
            
            <!-- 他のフォームフィールド -->
            <div class="description">
                <div class = "form-work">
                    <label>・科目</label><br>
                    <input type="text" name="country_name" maxlength="15" value="{{old("country_name" , $country->country_Name) }}" ><br>
                </div>
            </div>
            <div class="links">
                <div class="left-link">
                    <input type="submit" class="button-store">
                </div>
                <div class="right-link">
                    <a href="{{ route('countries.index') }}"class="button-back">一覧へ戻る</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
