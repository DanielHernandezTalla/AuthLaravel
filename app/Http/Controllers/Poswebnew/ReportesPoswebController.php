<?php

namespace App\Http\Controllers\Poswebnew;

use App\Http\Controllers\Controller;
use App\Models\Poswebnew\DatCortesTienda;
use App\Models\Poswebnew\DatEncabezado;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportesPoswebController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:reportesposweb');
    }

    public function concentradociudad(Request $request)
    {
        $fecha1 = !$request->fecha1 ? Carbon::now()->parse(date(now()))->format('Y-m-d') : $request->fecha1;
        $fecha2 = !$request->fecha2 ? Carbon::now()->parse(date(now()))->format('Y-m-d') : $request->fecha2;

        $concentrado = DatEncabezado::leftJoin('DatDetalle as b', 'b.IdEncabezado', 'DatEncabezado.IdEncabezado')
            ->leftJoin('CatArticulos as c', 'c.IdArticulo', 'b.IdArticulo')
            ->leftJoin('CatGrupos as d', 'd.IdGrupo', 'c.IdGrupo')
            ->leftJoin('CatTiendas as f', 'DatEncabezado.IdTienda', 'f.IdTienda')
            ->leftJoin('CatCiudades as g', 'f.IdCiudad', 'g.IdCiudad')
            ->select(DB::raw("g.NomCiudad,
                d.NomGrupo,
                SUM(b.CantArticulo) as kilos,
                SUM(b.ImporteArticulo) as importe"))
            ->where('DatEncabezado.StatusVenta', 0)
            ->whereNotNull('d.NomGrupo')
            ->whereRaw("cast(DatEncabezado.FechaVenta as date) between '" . $fecha1 . "' and '" . $fecha2 . "'")
            ->groupBy('g.NomCiudad', 'd.NomGrupo')
            ->orderBy('g.NomCiudad', 'desc')
            ->paginate(10);

        return view('poswebnew.reportes.concentradociudad', compact('concentrado'));
    }

    public function ventasaempleados(Request $request)
    {
        $fecha1 = $request->fecha1;
        $fecha2 = $request->fecha2;
        $chkNomina = $request->chkNomina;
        $numNomina = $request->numNomina;
        $paginate = $request->paginate ? $request->paginate : -1;

        if ($chkNomina == 'on') {
            $ventasEmpleado = DB::connection('POSWEBNEW')->table('DatCortesTienda as a')
                ->leftJoin('CatEmpleados as b', 'b.NumNomina', 'a.NumNomina')
                ->leftJoin('CatTiendas as c', 'c.IdTienda', 'a.IdTienda')
                ->leftJoin('DatEncabezado as d', 'd.IdEncabezado', 'a.IdEncabezado')
                ->select(
                    'a.NumNomina',
                    'a.FechaVenta',
                    'c.NomTienda',
                    'b.Nombre',
                    'b.Apellidos',
                    'b.Empresa',
                    'd.IdTicket',
                    'a.ImporteArticulo',
                    'a.StatusCredito',
                    'b.Status'
                )
                ->whereRaw("cast(a.FechaVenta as date) between '" . $fecha1 . "' and '" . $fecha2 . "'")
                ->where('a.NumNomina', $numNomina)
                ->where('d.StatusVenta', 0)
                ->orderBy('a.FechaVenta')
                ->paginate($paginate);

            $importeTotal = DatCortesTienda::whereRaw("cast(FechaVenta as date) between '" . $fecha1 . "' and '" . $fecha2 . "'")
                ->where('StatusVenta', 0)
                ->where('NumNomina', $numNomina)
                ->sum('ImporteArticulo');

            $importeCredito = DatCortesTienda::whereRaw("cast(FechaVenta as date) between '" . $fecha1 . "' and '" . $fecha2 . "'")
                ->whereNotNull('StatusCredito')
                ->where('StatusVenta', 0)
                ->where('NumNomina', $numNomina)
                ->sum('ImporteArticulo');
        } else {
            $ventasEmpleado = DB::connection('POSWEBNEW')->table('DatCortesTienda as a')
                ->leftJoin('CatEmpleados as b', 'b.NumNomina', 'a.NumNomina')
                ->leftJoin('CatTiendas as c', 'c.IdTienda', 'a.IdTienda')
                ->leftJoin('DatEncabezado as d', 'd.IdEncabezado', 'a.IdEncabezado')
                ->select(
                    'a.NumNomina',
                    'a.FechaVenta',
                    'c.NomTienda',
                    'b.Nombre',
                    'b.Apellidos',
                    'b.Empresa',
                    'd.IdTicket',
                    'a.ImporteArticulo',
                    'a.StatusCredito',
                    'b.Status'
                )
                ->whereRaw("cast(a.FechaVenta as date) between '" . $fecha1 . "' and '" . $fecha2 . "'")
                ->whereNotNull('a.NumNomina')
                ->paginate($paginate);

            $importeTotal = DatCortesTienda::whereRaw("cast(FechaVenta as date) between '" . $fecha1 . "' and '" . $fecha2 . "'")
                ->where('StatusVenta', 0)
                ->whereNotNull('NumNomina')
                ->sum('ImporteArticulo');

            $importeCredito = DatCortesTienda::whereRaw("cast(FechaVenta as date) between '" . $fecha1 . "' and '" . $fecha2 . "'")
                ->whereNotNull('StatusCredito')
                ->where('StatusVenta', 0)
                ->sum('ImporteArticulo');
        }

        return view('poswebnew.reportes.ventasaempleados', compact('ventasEmpleado', 'fecha1', 'fecha2', 'importeTotal', 'importeCredito', 'chkNomina', 'numNomina'));
    }
}
