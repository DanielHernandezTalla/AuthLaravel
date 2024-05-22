<?php

namespace App\Http\Controllers;

use App\Models\type_permissions;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Throwable;

class PermisosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:permisos');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paginate = $request->paginate ? $request->paginate : 10;
        $name = $request->name;
        $type = $request->type;

        $type_permissions = type_permissions::get();

        $permissions = Permission::select(
            'permissions.id',
            'permissions.name',
            'permissions.created_at',
            'permissions.updated_at',
            'type_permissions.name as type'
        )
            ->leftjoin('type_permissions', 'type_permissions.id', 'type_permissions_id')
            ->where('permissions.name', 'like', '%' . $name . '%')
            ->when($type, function ($query) use ($type) {
                $query->where('type_permissions.id', $type);
            })
            ->orderby('type_permissions.name')
            ->orderby('permissions.name')
            ->paginate($paginate);

        return view('permisos.index', compact('name', 'type', 'type_permissions', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permisos.create');
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
            Permission::create(['name' => $request->name, 'guard_name' => 'web']);
            return redirect()->route('datos.permisos.index');
        } catch (Throwable $e) {
            return back()->withErrors(['El permiso no pudo ser incertado correctamente, intente de nuevo.', $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $paginate = $request->paginate ? $request->paginate : 10;
        $permission = Permission::with('roles')->where('id', $id)->first();
        $roles = Role::whereNotIn('id', $permission->roles->pluck('id'))
            ->get();

        $rolespermisos = Role::whereIn('id', $permission->roles->pluck('id'))
            ->paginate($paginate);

        return view('permisos.[id]', compact('permission', 'roles', 'rolespermisos'));
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
        if ($request->updateName == 1) {
            Permission::where('id', $id)->update(['name' => $request->name]);
        } else {
            $permission = Permission::where('id', $id)->first();
            $rol = Role::where('id', $request->rol)->first();

            $permission->assignRole($rol);
        }
        return back()->with('success', 'Actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permiso = Permission::with('roles', 'users')->where('id', $id)->first();

        if (count($permiso->roles) > 0) {
            return back()->with('error', 'El permiso cuenta con roles asignados.');
        }

        if (count($permiso->users) > 0) {
            return back()->with('error', 'El permiso cuenta con usuarios asignados.');
        }
        $permiso->delete();
        return back()->with('success', 'El permiso se elimino correctamente.');
    }
}
