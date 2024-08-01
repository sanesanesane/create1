<h1>美術館登録</h1>

<form method="post" action="{{route('museums.store')}}">
    @csrf

<label>美術館名</label><br>
<input type='text' name="museum_name" value="" placeholder="施設名"><br>

</form>