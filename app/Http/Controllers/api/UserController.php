<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\api\Email as Email;

class UserController extends Controller
{
    //* Registrar un nuevo usuario
    public function register(Request $request)
    {
        // Validar los campos
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:16',
            'phone' => 'required|string',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->save();
        // Enviar correo de bienvenida
        $email = new Email();
        $email->sendEmail(
            $request->email,
            'Bienvenido a la aplicación',
            'Hola ' . $request->name . ', bienvenido a la aplicación. Su registro fue exitoso.'
        );

        if ($user) { // Si el usuario se guardó correctamente
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'success' => true,
                'status' => 1,
                'message' => 'Usuario creado correctamente',
                'data' => $user,
                'token' => $token
            ]);
        } else {
            return response()->json([
                'success' => false,
                'status' => 0,
                'message' => 'Error al crear el usuario'
            ]);
        }
    }

    //* Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|max:16'
        ]);
        $user = User::where('email', $request->email)->first();
        if (isset($user)) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'success' => true,
                    'status' => 1,
                    'message' => 'Inicio de sesión correcto',
                    'data' => $user,
                    'token' => $token
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'status' => 0,
                    'message' => 'Credenciales incorrectas'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'status' => 0,
                'message' => 'Credenciales incorrectas'
            ]);
        }
    }

    //* Logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => 1,
            'message' => 'Usuario deslogueado con éxito',
        ], 200);
    }
}
