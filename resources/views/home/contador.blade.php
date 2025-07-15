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
                        <tr>
                            <td><a href="/abc1234" target="_blank">localhost/abc1234</a></td>
                            <td class="text-end">42</td>
                        </tr>
                        <tr>
                            <td><a href="/xyz5678" target="_blank">localhost/xyz5678</a></td>
                            <td class="text-end">17</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 