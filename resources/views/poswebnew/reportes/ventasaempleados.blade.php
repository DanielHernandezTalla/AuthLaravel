@extends('layouts.app')
@section('title', 'Ventas a empleados')
@section('content')

    @include('components.header', [
        // 'button' => ['name' => 'Exportar', 'url' => 'datos.user.create'],
    ])

    <div class="section">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <x-tablas.number-pagination isReport />

            <form class="d-flex align-items-center justify-content-end p-0 gap-2"
                action="{{ route('poswebnew.ventasaempleados') }}">
                <div class="col-auto">
                    <input class="form-control" type="date" name="fecha1" id="fecha1"
                        value="{{ empty($fecha1) ? date('Y-m-d') : $fecha1 }}">
                </div>
                <div class="col-auto">
                    <input class="form-control" type="date" name="fecha2" id="fecha2"
                        value="{{ empty($fecha2) ? date('Y-m-d') : $fecha2 }}">
                </div>
                <div class="col-auto">
                    <div class="input-group">
                        <span class="input-group-text card">Buscar Empleado</span>
                        <span class="input-group-text">
                            <input {!! $chkNomina == 'on' ? 'checked' : '' !!} class="form-check-input mt-0" type="checkbox" name="chkNomina"
                                id="chkNomina">
                        </span>
                        <input {!! $chkNomina == 'on' ? '' : 'disabled' !!} class="form-control" type="number" name="numNomina" id="numNomina"
                            value="{!! $chkNomina == 'on' ? $numNomina : 'disabled' !!}" required>
                    </div>
                </div>
                <div class="col-auto">
                    <button class="btn btn-outline-dark">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Fecha Compra</th>
                    <th>Tienda</th>
                    <th>Nómina</th>
                    <th>Empleado</th>
                    <th>Empresa</th>
                    <th>Ticket</th>
                    <th>Importe</th>
                    <th>Crédito</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventasEmpleado as $item)
                    <tr>
                        <td>{{ strftime('%d %B %Y, %H:%M', strtotime($item->FechaVenta)) }}</td>
                        <td>{{ $item->NomTienda }}</td>
                        <td>{{ $item->NumNomina }}</td>
                        <td>{{ $item->Nombre }} {{ $item->Apellidos }}</td>
                        <td>{{ $item->Empresa }}</td>
                        <td>{{ $item->IdTicket }}</td>
                        <td>{{ number_format($item->ImporteArticulo, 2) }}</td>
                        <td>
                            @if ($item->StatusCredito == '0')
                                <i class="h5 bi bi-check-lg"></i>
                            @endif
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    @if ($ventasEmpleado->withQueryString()->lastPage() != 1)
        <div class="section-min">
            {!! $ventasEmpleado->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    @endif

    <script>
        const chkNomina = document.getElementById('chkNomina');
        const numNomina = document.getElementById('numNomina');
        chkNomina.addEventListener('click', function() {
            if (numNomina.disabled == true) {
                numNomina.disabled = false;
            } else {
                numNomina.value = '';
                numNomina.disabled = true;

            }
        });
    </script>

@endsection
