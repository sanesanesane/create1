<h1>〇地域登録</h1>

<form action="{{ route('countries.store') }}" method="POST">
    @csrf
    <!-- 他のフォームフィールド -->

<label>年代・時代</label><br>
<input type="text" name="country_name" maxlength="15" value="" placeholder="作者名"><br>

<input type="submit" value='登録'>

</form>
<div>
    <a href="{{ route('home.index') }}">ホームへ戻る</a>
</div>