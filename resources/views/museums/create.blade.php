<h1>美術館登録</h1>

<form method="post" action="{{route('museums.store')}}">
    @csrf

<label>美術館名</label><br>
<input type='text' name="museum_name" value="" placeholder="施設名"><br>

<label>美術館内容</label><br>
<input type='text' name="museum_content" value="" placeholder="概要"><br>

<label>所在地</label><br>
<input type="text" name="museum_api" maxlength="40" value="" placeholder="住所"><br>

<input type="submit" value='登録'>

<div>
    <a href="{{ route('home.index') }}">ホームへ戻る</a>
</div>

</form>