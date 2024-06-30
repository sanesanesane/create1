<h1> 〇作品登録 </h1>

<form action="//www-creators.com/rsc/receiver.php" method="post">
    <label>作品の名前</label><br>
    <input type="text" name="work_name" maxlength="10" value="" placeholder="作品の名前">
  </form>

     <div class="form-group">
      <label for="subject-id">{{ __('科目') }}
      <select class="form-control" id="subject-id" name="subject_neme" style="width: 100px; height: 20px;">
          @foreach ($subjects as $subject)
              <option value="{{ $subject->subject_ID }}">{{ $subject->subject_Name }}</option>
          @endforeach
      </select>
    </div>

    <div class="form-group">
        <label for="age-id">{{ __('年代') }}
        <select class="form-control" id="age-id" name="age_name" style="width: 100px; height: 20px;">
            @foreach ($ages as $age)
                <option value="{{ $age->age_ID }}">{{ $age->age_Name }}</option>
            @endforeach
        </select>
      </div>

    <div class="form-group">
        <label for="country-id">{{ __('地域') }}
        <select class="form-control" id="country-id" name="country_name" style="width: 100px; height: 20px;">
            @foreach ($countries as $country)
                <option value="{{ $country->country_ID }}">{{ $country->country_Name }}</option>
            @endforeach
        </select>
      </div>

    <div class="form-group">
        <label for="museum-id">{{ __('美術館') }}
        <select class="form-control" id="museum-id" name="museum_name" style="width: 100px; height: 20px;">
            @foreach ($museums as $museum)
                <option value="{{ $museum->museum_ID }}">{{ $museum->museum_Name }}</option>
            @endforeach
        </select>
      </div>
  


  