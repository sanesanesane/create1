<!DOCTYPE html>
<html>

<head>
    <title>作品編集</title>
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


        <form method="post" action="{{ route('works.update', $work) }}">
            @csrf
            @method('patch')

            <div class="description">
                <div class = "form-work">
                    <label>作品の名前</label><br>
                    <input type="text" name="work_name" maxlength="35"
                        value="{{ old('work_name', $work->work_name) }}"  required><br>
                        @error('name')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class = "form-work">
                    <label>作者名</label><br>
                    <input type="text" name="author_name" maxlength="25"
                        value="{{ old('author_name', $work->work_artist) }}"><br>

                        @error('artist')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                </div>

                <div class = "form-work">
                    <label for="subject-id">{{ __('科目') }}</label><br>
                    <select class="form-control" id="subject-id" name="subject_id">
                        @foreach ($subjects as $subject)
                            <option
                                value="{{ $subject->subject_ID }}"{{ old('subject_id', $work->subject_id) == $subject->subject_ID ? 'selected' : '' }}>
                                {{ $subject->subject_Name }}

                            </option>
                        @endforeach
                    </select>
                    @error('subject_id')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
                </div>

                <div class = "form-work">
                    <label for="age-id">{{ __('年代') }}</label><br>
                    <select class="form-control" id="age-id" name="age_id">
                        @foreach ($ages as $age)
                            <option
                                value="{{ $age->age_ID }}"{{ old('age_id', $work->age_id) == $age->age_ID ? 'selected' : '' }}>
                                {{ $age->age_Name }}
                            </option>
                        @endforeach
                    </select>
                    @error('age_id')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
                </div>

                <div class = "form-work">
                    <label for="country-id">{{ __('地域') }}</label><br>
                    <select class="form-control" id="country-id" name="country_id">
                        @foreach ($countries as $country)
                            <option
                                value="{{ $country->country_ID }}"{{ old('country_id', $work->country_id) == $country->country_ID ? 'selected' : '' }}>
                                {{ $country->country_Name }}
                            </option>
                        @endforeach
                    </select>
                    @error('country_id')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
                </div>

                <div class = "form-work">
                    <label for="museum-id">{{ __('美術館') }}</label><br>
                    <select class="form-control" id="museum-id" name="museum_id" >
                        @foreach ($museums as $museum)
                            <option
                                value="{{ $museum->museum_ID }}"{{ old('museum_id', $work->museum_id) == $museum->museum_ID ? 'selected' : '' }}>
                                {{ $museum->museum_Name }}
                            </option>
                        @endforeach
                    </select>
                    @error('museum_id')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
                </div>

                <div class = "form-work">
                    <label>作品説明</label><br>
                    <textarea name="work_description" cols="60" rows="5">{{ old('work_description', $work->work_description) }}</textarea><br>
                    @error('description')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
                </div>

                <div class="links">
                    <div class="left-link">
                        <input type="submit" value='更新' button class="button-store">
                    </div>
                    <div>
                        <a href="{{ route('works.index') }}"class="button-back">戻る</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>