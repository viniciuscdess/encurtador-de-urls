@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h2 class="mb-4 text-center">Contador de Cliques</h2>
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>URL Curta</th>
                            <th class="text-end">Quantidade de Cliques</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($urls) && count($urls) > 0)
                            @foreach($urls as $url)
                            <tr>
                                <td>
                                    <a href="{{ url('/' . $url->url_modify) }}" target="_blank">
                                        {{ url('/' . $url->url_modify) }}
                                    </a>
                                </td>
                                <td class="text-end">{{ $url->redirects }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="2" class="text-center">Nenhuma URL encontrada.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 