@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="w-100" style="max-width: 400px;">
        <div class="text-center mb-4">
            <h1 class="fw-bold">Encurtador de URL</h1>
            <p class="text-muted">Cole sua URL abaixo para encurtar rapidamente</p>
        </div>

        @if(session('success'))  
            <div class="alert alert-success text-center">
                URL encurtada: <a href="{{ $data['url_modify'] }}" target="_blank">{{ $data['url_modify'] }}</a>
            </div>
        @endif

        <form action="{{ route('home.shorten') }}" method="post" class="card p-4 shadow-sm border-0">
            @csrf
            <div class="mb-3">
                <input type="text" name="url_original" class="form-control form-control-lg" placeholder="Cole a URL aqui" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 btn-lg">Encurtar</button>
        </form>
    </div>
</div>
@endsection