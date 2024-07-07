<h1>〇作品登録</h1>

<form action="{{ route('works.store') }}" method="POST">
    @csrf <!-- LaravelのCSRF保護のため -->
    
    <label>作品の名前</label><br>
    <input type="text" name="work_name" maxlength="15" value="" placeholder="作品の名前"><br>
    
    <label>作者名</label><br>
    <input type="text" name="author_name" maxlength="15" value="" placeholder="作者名"><br>
    
    <div class="form-group">
        <label for="subject-id">{{ __('科目') }}</label><br>
        <select class="form-control" id="subject-id" name="subject_id" style="width: 100px; height: 20px;">
            @foreach ($subjects as $subject)
                <option value="{{ $subject->subject_ID }}">{{ $subject->subject_Name }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="form-group">
        <label for="age-id">{{ __('年代') }}</label><br>
        <select class="form-control" id="age-id" name="age_id" style="width: 100px; height: 20px;">
            @foreach ($ages as $age)
                <option value="{{ $age->age_ID }}">{{ $age->age_Name }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="form-group">
        <label for="country-id">{{ __('地域') }}</label><br>
        <select class="form-control" id="country-id" name="country_id" style="width: 100px; height: 20px;">
            @foreach ($countries as $country)
                <option value="{{ $country->country_ID }}">{{ $country->country_Name }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="form-group">
        <label for="museum-id">{{ __('美術館') }}</label><br>
        <select class="form-control" id="museum-id" name="museum_id" style="width: 100px; height: 20px;">
            @foreach ($museums as $museum)
                <option value="{{ $museum->museum_ID }}">{{ $museum->museum_Name }}</option>
            @endforeach
        </select>
    </div>
    
    <label>作品説明</label><br>
    <textarea name="work_description" cols="60" rows="5"></textarea><br>
    
    <input type="submit" value='登録'>
</form>



  


  