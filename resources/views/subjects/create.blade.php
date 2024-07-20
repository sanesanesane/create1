<h1>〇科目登録</h1>

<form action="{{ route('subjects.store') }}" method="POST">
    @csrf
    <!-- 他のフォームフィールド -->

<label>科目名</label><br>
<input type="text" name="subject_name" maxlength="15" value="" placeholder="科目名"><br>

<input type="submit" value='登録'>

</form>
<div>
    <a href="{{ route('home.index') }}">ホームへ戻る</a>
</div>