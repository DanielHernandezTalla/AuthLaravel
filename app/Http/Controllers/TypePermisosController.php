<?php

namespace App\Http\Controllers;

use App\Models\type_permissions;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Throwable;

class TypePermisosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('can:typepermisos');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paginate = $request->paginate ? $request->paginate : 10;
        $name = $request->name;

        $type_permissions = type_permissions::where('name', 'like', '%' . $name . '%')
            ->paginate($paginate);

        return view('typepermisos.index', compact('name', 'type_permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('typepermisos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'name' => 'min:3'
        ]);

        try {
            type_permissions::create(['name' => $request->name]);
            return redirect()->route('datos.typepermissions.index')->with('success', 'Categoría agregada correctamente.');
        } catch (Throwable $e) {
            return back()->withErrors(['La categoría no pudo ser incertada correctamente, intente de nuevo.', $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $type_permission = type_permissions::where('id', $id)->first();

        return view('typepermisos.[id]', compact('type_permission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        type_permissions::where('id', $id)->update(['name' => $request->name]);

        return redirect()->route('datos.typepermissions.index')->with('success', 'Actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $type_permissions = type_permissions::with('permissions')->where('id', $id)->first();

        if (!empty($type_permissions->permissions)) {
            return back()->with('error', 'la categoría cuenta con permisos asignados.');
        }

        $type_permissions->delete();
        return back()->with('success', 'El permiso se elimino correctamente.');
    }
}
