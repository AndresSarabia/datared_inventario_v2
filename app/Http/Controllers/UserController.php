<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function datatables()
    {
        $users = User::query();

        return DataTables::of($users)
            ->addColumn('perfil_badge', function ($user) {
                return match ($user->perfil) {
                    'administrador' => '<span class="badge badge-primary">Administrador</span>',
                    'supervisor' => '<span class="badge badge-info">Supervisor</span>',
                    'tecnico' => '<span class="badge badge-secondary">Técnico</span>',
                    default => '<span class="badge badge-light">'.$user->perfil.'</span>',
                };
            })
            ->addColumn('estado_badge', function ($user) {
                return $user->estado
                    ? '<span class="badge badge-success">Habilitado</span>'
                    : '<span class="badge badge-danger">Deshabilitado</span>';
            })
            ->addColumn('fecha_registro', function ($user) {
                return $user->created_at ? $user->created_at->format('d/m/Y H:i:s') : '';
            })
            ->rawColumns(['perfil_badge', 'estado_badge'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 45 caracteres.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'apellidos.max' => 'Los apellidos no pueden tener más de 64 caracteres.',
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Debes ingresar un correo válido.',
            'email.unique' => 'Ese correo ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'La confirmación de contraseña no coincide.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'perfil.required' => 'El perfil es obligatorio.',
            'perfil.string' => 'El perfil debe ser texto válido.',
            'perfil.in' => 'El perfil seleccionado no es válido.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ];
        
        $validated = $request->validate([
            'nombre' => 'required|string|max:45',
            'apellidos' => 'required|string|max:64',
            'ci' => 'nullable|string|max:255',
            'sexo' => 'nullable|string|max:10',
            'cargo' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'perfil' => 'required|in:administrador,supervisor,tecnico',
            'estado' => 'nullable|in:0,1',
        ], $messages);

        $validated['password'] = Hash::make($validated['password']);
        $validated['estado'] = $validated['estado'] ?? '1';

        $user = User::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Usuario creado correctamente',
            'user' => $user,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $usuario)
    {
        $messages = [
            'nombre.required' => 'El nombre es obligatorio.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Debes ingresar un correo válido.',
            'email.unique' => 'Ese correo ya está registrado.',
        ];

        $validated = $request->validate([
            'nombre' => 'required|string|max:45',
            'apellidos' => 'required|string|max:64',
            'ci' => 'nullable|string|max:255',
            'sexo' => 'nullable|string|max:10',
            'cargo' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,'.$usuario->id,
        ], $messages);

        $usuario->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Usuario actualizado correctamente',
            'user' => $usuario,
        ]);
    }

    public function updatePassword(Request $request, User $usuario)
    {
        $messages = [
            'current_password.required' => 'La contraseña actual es obligatoria.',
            'password.required' => 'La contraseña nueva es obligatoria.',
            'password.confirmed' => 'La confirmación de contraseña no coincide.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ];

        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ], $messages);

        if (!Hash::check($validated['current_password'], $usuario->password)) {
            return response()->json([
                'message' => 'La contraseña actual es incorrecta.'
            ], 422);
        }

        $usuario->password = Hash::make($validated['password']);
        $usuario->save();

        return response()->json([
            'success' => true,
            'message' => 'Contraseña actualizada correctamente',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
        $usuario->estado = '0';
        $usuario->save();

        return response()->json([
            'success' => true,
            'message' => 'Usuario deshabilitado correctamente.',
        ]);
    }

    public function info_list_usu()
    {
        $usuarios = User::all();
        $usu_log = auth()->user()->nombre . ' ' . auth()->user()->apellidos;

        $pdf = Pdf::loadView('users.info_list_usu', compact('usuarios', 'usu_log'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('listado_usuarios.pdf');
    }
}
