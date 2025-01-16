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

        <!-- 一般的なエラーメッセージの表示 -->
        @if (session('error'))
            <div class="alert alert-danger" style="color: red;>
                {{ session('error') }}
            </div>
        @endif



        <form action="{{ route('works.store') }}" method="POST">
            @csrf
            <div class="description">
                <div class = "form-work">
                    <label>・作品の名前</label><br>
                    <input type="text" name="work_name" maxlength="35" value="" placeholder="作品の名前" required>
                    @error('name')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                </div>

                <div class = "form-work">
                    <label>・作者名</label><br>
                    <input type="text" name="author_name" maxlength="25" value="" placeholder="作者名" required>
                    @error('artist')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
                </div>

                <div class = "form-work">
                    <label for="subject-id">{{ __('・科目') }}</label>
                    <select class="form-work" id="subject-id" name="subject_id">
                        <option value="" disabled selected>必ず選択してください</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->subject_ID }}">{{ $subject->subject_Name }}</option>
                        @endforeach
                    </select>
                    @error('subject_id')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
                </div>

                <div class="form-work">
                    <label for="age-id">{{ __('・年代') }}</label><br>
                    <select class="form-control" id="age-id" name="age_id">
                        <option value="" disabled selected>必ず選択してください</option>
                        @foreach ($ages as $age)
                            <option value="{{ $age->age_ID }}">{{ $age->age_Name }}</option>
                        @endforeach
                    </select>
                    @error('age_id')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
                </div>

                <div class="form-work">
                    <label for="country-id">{{ __('・地域') }}</label><br>
                    <select class="form-control" id="country-id" name="country_id">
                        <option value="" disabled selected>必ず選択してください</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->country_ID }}">{{ $country->country_Name }}</option>
                        @endforeach
                    </select>
                    @error('country_id')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
                </div>

                <div class="form-work">
                    <label for="museum-id">{{ __('・美術館') }}</label><br>
                    <select class="form-control" id="museum-id" name="museum_id">
                        <option value="" disabled selected>必ず選択してください</option>
                        @foreach ($museums as $museum)
                            <option value="{{ $museum->museum_ID }}">{{ $museum->museum_Name }}</option>
                        @endforeach
                    </select>
                    @error('museum_id')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
                </div>

                <div class="form-work">
                    <label>・作品説明</label><br>
                    <textarea name="work_description" cols="40" rows="7"></textarea><br>
                    @error('description')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
                </div>


                <div class="links">
                    <div class="left-link">
                        <button class="button-store">登録</button>
                    </div>
                    <div class="right-link">
                        <a href="{{ route('home.index') }}"class="button-back">戻る</a>
                        
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
