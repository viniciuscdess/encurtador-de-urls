<h1>home</h1>

@if(session('url_modify'))  
    <p>URL encurtada: {{ session('url_modify') }}</p>
@endif

<form action="{{ route('home.encurtar') }}" method="post">
    @csrf
    <input type="text" name="url" placeholder="URL">
    <button type="submit">Encurtar</button>
</form>