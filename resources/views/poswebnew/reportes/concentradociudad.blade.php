@extends('layouts.app')
@section('title', 'Concentrado por ciudad')
@section('content')

    @include('components.header', [
        'button' => ['name' => 'Exportar', 'url' => 'datos.users.create'],
    ])

    <div class="section">
        <h4>Listado de usuarios</h4>
        <table>
            <thead>
                <tr>
                    <th>Ciudad</th>
                    <th>Familia</th>
                    <th class="text-center">Kilos</th>
                    <th class="text-center">Importe</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($concentrado as $item)
                    <tr>
                        <td>{{ $item->NomCiudad }}</td>
                        <td>{{ $item->NomGrupo }}</td>
                        <td class="text-end">{{ number_format($item->kilos, 2) }}</td>
                        <td class="text-end">${{ number_format($item->importe, 2) }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    @if ($concentrado->withQueryString()->lastPage() != 1)
        <div class="section-min">
            {!! $concentrado->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    @endif

@endsection
