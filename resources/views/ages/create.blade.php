<h1>〇年代登録</h1>

<form action="{{ route('ages.store') }}" method="POST">
    @csrf
    <!-- 他のフォームフィールド -->

<label>年代・時代</label><br>
<input type="text" name="age_name" maxlength="15" value="" placeholder="年代"><br>

<input type="submit" value='登録'>

</form>
<div>
    <a href="{{ route('home.index') }}">ホームへ戻る</a>
</div>