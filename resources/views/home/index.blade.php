<h1>home</h1>
<form action="{{ route('home.encurtar') }}" method="post">
    @csrf
    <input type="text" name="url" placeholder="URL">
    <button type="submit">Encurtar</button>
</form>