<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:users');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $paginate = $request->paginate ? $request->paginate : 10;
        $name = $request->name;
        $users = User::with('roles')
            ->where('name', 'like', '%' . $name . '%')
            ->paginate($paginate);

        return view('user.index', compact('name', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::get();

        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => $request->password, // password
            'remember_token' => Str::random(10),
        ])->assignRole($request->idRol);
        return redirect()->route('datos.users.index')->with('success', 'Usuario creado con exito!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $roles = Role::get();

        $user = User::with('roles')
            ->where('id', $id)
            ->first();

        return view('user.[id]', compact('user', 'roles'));
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
    public function update(UserRequest $request, string $id)
    {
        // return ;
        $role = Role::where('id', $request->idRol)->first();
        $user = User::with(['roles'])->findOrFail($id);

        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            // 'password' => Hash::make($request->password),
        ]);

        $user->syncRoles([$role->name]);
        return redirect()->route('datos.users.index')->with('success', 'Operacion realizada con exito!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = User::with('permissions', 'roles')->where('id', $id)->first();

        $usuario->delete();
        return back()->with('success', 'El usuario se elimino correctamente.');
    }
}
