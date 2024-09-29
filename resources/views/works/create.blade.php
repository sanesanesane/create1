<!DOCTYPE html>
<html>
<head>
    <title>作品登録</title>
    <link rel="stylesheet" href="{{ asset('css/sane.css') }}">
</head>

<body>
    <div class="container">
        <div>
            <h1>〇作品登録</h1>
        </div>

        <!-- エラーメッセージの表示 -->
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



        <form action="{{ route('works.store') }}" method="POST">
            @csrf
            <div class="description">
                <div class = "form-work">
                    <label>・作品の名前</label><br>
                    <input type="text" name="work_name" maxlength="15" value="" placeholder="作品の名前">
                </div>

                <div class = "form-work">
                    <label>・作者名</label><br>
                    <input type="text" name="author_name" maxlength="15" value="" placeholder="作者名">
                </div>

                <div class = "form-work">
                    <label for="subject-id">{{ __('・科目') }}</label>
                    <select class="form-work" id="subject-id" name="subject_id">
                        <option value="" disabled selected>必ず選択してください</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->subject_ID }}">{{ $subject->subject_Name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-work">
                    <label for="age-id">{{ __('・年代') }}</label><br>
                    <select class="form-control" id="age-id" name="age_id">
                        <option value="" disabled selected>必ず選択してください</option>
                        @foreach ($ages as $age)
                            <option value="{{ $age->age_ID }}">{{ $age->age_Name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-work">
                    <label for="country-id">{{ __('・地域') }}</label><br>
                    <select class="form-control" id="country-id" name="country_id">
                        <option value="" disabled selected>必ず選択してください</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->country_ID }}">{{ $country->country_Name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-work">
                    <label for="museum-id">{{ __('・美術館') }}</label><br>
                    <select class="form-control" id="museum-id" name="museum_id">
                        <option value="" disabled selected>必ず選択してください</option>
                        @foreach ($museums as $museum)
                            <option value="{{ $museum->museum_ID }}">{{ $museum->museum_Name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-work">
                    <label>・作品説明</label><br>
                    <textarea name="work_description" cols="60" rows="5"></textarea><br>
                </div>


                <div class="links">
                    <div class="left-link">
                        <button class="button-store">登録</button>
                    </div>
                    <div class="right-link">
                        <input type="button" class="button-back" value="戻る" onclick= "history.back()">
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
