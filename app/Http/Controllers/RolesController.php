<?php

namespace App\Http\Controllers;

use App\Models\type_permissions;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:roles');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paginate = $request->paginate ? $request->paginate : 10;
        $name = $request->name;
        $roles = Role::where('name', 'like', '%' . $name . '%')
            ->paginate($paginate);

        return view('roles.index', compact('name', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Role::create(['name' => $request->name]);
        return redirect()->route('datos.roles.index')->with('success', 'Rol creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $paginate = $request->paginate ? $request->paginate : 10;
        $name = $request->name;
        $type = $request->type;
        $role = Role::where('id', $id)->first();
        $permisos = Permission::whereNotIn('id', $role->permissions->pluck('id'))
            ->get();

        $rolespermisos = Permission::whereIn('id', $role->permissions->pluck('id'))
            ->paginate($paginate);

        $type_permissions = type_permissions::get();

        $rolespermisos = Permission::select(
            'permissions.id',
            'permissions.name',
            'permissions.created_at',
            'permissions.updated_at',
            'type_permissions.name as type'
        )
            ->leftjoin('type_permissions', 'type_permissions.id', 'type_permissions_id')
            ->whereIn('permissions.id', $role->permissions->pluck('id'))
            ->where('permissions.name', 'like', '%' . $name . '%')
            ->when($type, function ($query) use ($type) {
                $query->where('type_permissions.id', $type);
            })
            ->orderby('type_permissions.name')
            ->orderby('permissions.name')
            ->paginate($paginate);


        return view('roles.[id]', compact('role', 'name', 'type', 'permisos', 'rolespermisos', 'type_permissions'));
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
            Role::where('id', $id)->update(['name' => $request->name]);
        } else {
            $rol = Role::where('id', $id)->first();
            $permiso = Permission::where('id', $request->permiso)->first();

            $permiso->assignRole($rol);
        }
        return back()->with('success', 'Actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $rol = Role::where('id', $id)->first();
        $role = Role::with('permissions', 'users')->where('id', $id)->first();

        if (count($role->permissions) > 0) {
            return back()->with('error', 'El rol cuenta con permisos asignados.');
        }

        if (count($role->users) > 0) {
            return back()->with('error', 'El rol cuenta con usuarios asignados.');
        }

        $role->delete();
        return back()->with('success', 'El rol se elimino correctamente.');
    }

    /**
     * Remove permissions the specified resource from storage.
     */
    public function destroyPermissions(Request $request, string $id)
    {
        $rol = Role::where('id', $id)->first();
        $permiso = Permission::where('id', $request->permission)->first();

        $permiso->removeRole($rol);
        return back()->with('success', 'Permiso eliminado correctamente.');
    }
}
