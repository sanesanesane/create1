<h1> 〇作品登録 </h1>

<form action="//www-creators.com/rsc/receiver.php" method="post">
    <label>作品の名前</label><br>
    <input type="text" name="work-name" maxlength="15" value="" placeholder="作品の名前">
  </form>

  <form action="//www-creators.com/rsc/receiver.php" method="post">
    <label>作者名</label><br>
    <input type="text" name="author-name" maxlength="15" value="" placeholder="作品の名前">
  </form>

     <div class="form-group">
      <label for="subject-id">{{ __('科目') }}</label><br>
      <select class="form-control" id="subject-id" name="subject-name" style="width: 100px; height: 20px;">
          @foreach ($subjects as $subject)
              <option value="{{ $subject->subject_ID }}">{{ $subject->subject_Name }}</option>
          @endforeach
      </select>
    </div>

    <div class="form-group">
        <label for="age-id">{{ __('年代') }}</label><br>
        <select class="form-control" id="age-id" name="age-name" style="width: 100px; height: 20px;">
            @foreach ($ages as $age)
                <option value="{{ $age->age_ID }}">{{ $age->age_Name }}</option>
            @endforeach
        </select>
      </div>

    <div class="form-group">
        <label for="country-id">{{ __('地域') }}</label><br>
        <select class="form-control" id="country-id" name="country-name" style="width: 100px; height: 20px;">
            @foreach ($countries as $country)
                <option value="{{ $country->country_ID }}">{{ $country->country_Name }}</option>
            @endforeach
        </select>
      </div>

    <div class="form-group">
        <label for="museum-id">{{ __('美術館') }}</label><br>
        <select class="form-control" id="museum-id" name="museum-name" style="width: 100px; height: 20px;">
            @foreach ($museums as $museum)
                <option value="{{ $museum->museum_ID }}">{{ $museum->museum_Name }}</option>
            @endforeach
        </select>
      </div>
    
      <form action="//www-creators.com/rsc/receiver.php" method="post">
        <label>作者名</label><br>
        <textarea name = "author-id" cols="60" rows="5"></textarea>
      </form>


      <form action="{{ route('works.store') }}" method="POST">
        @csrf <!-- LaravelのCSRF保護のため -->
        <p>
        <input type = "submit" value = '登録'>
      </p>
      </form>



  


  