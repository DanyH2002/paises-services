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
            'gender' => 'required|string',
            'birthdate' => 'required|date',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->birthdate = $request->birthdate;
        $user->save();
        // Enviar correo de bienvenida
        $email = new Email();
        $email->sendEmail(
            $request->email,
            'Bienvenido a la aplicación',
            'Hola ' . $request->name . ', bienvenido a la aplicación. Su registro fue exitoso.'
        );

        if ($user) { // Si el usuario se guardó correctamente
            return response()->json([
                'success' => true,
                'status' => 1,
                'message' => 'Usuario creado correctamente',
                'data' => $user
            ]);
        } else {
            return response()->json([
                'success' => false,
                'status' => 0,
                'message' => 'Error al crear el usuario'
            ]);
        }
    }

    //* Cambiar contraseña
    public function changePassword(Request $request, $id)
    {
        $user = User::find($request->id); // Buscar el usuario por ID
        if ($user) { // Si el usuario existe
            $user->password = Hash::make($request->password); // Cambiar la contraseña
            // Obtener el email del usuario
            $email = $user->email;
            $user->save(); // Guardar los cambios
            if ($user) { // Si la contraseña se cambió correctamente
                // Enviar correo de cambio de contraseña
                $emailSender = new Email();
                $emailSender->sendEmail(
                    $email,
                    'Cambio de contraseña',
                    'Hola ' . $user->name . ', su contraseña ha sido cambiada correctamente. Su nueva contraseña es: ' . $request->password
                );
                return response()->json([
                    'success' => true,
                    'status' => 1,
                    'message' => 'Contraseña cambiada correctamente',
                    'data' => $user
                ]);
            }
            return response()->json([
                'success' => false,
                'status' => 0,
                'message' => 'Error al cambiar la contraseña'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'status' => 0,
                'message' => 'Usuario no encontrado'
            ]);
        }
    }

    //? Actualizar un usuario
    public function update(Request $request, $id)
    {
        $user = User::find($id); // Buscar el usuario por ID
        if ($user) { // Si el usuario existe
            $user->name = $request->name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->gender = $request->gender;
            $user->birthdate = $request->birthdate;
            $user->save(); // Guardar los cambios
            if ($user) { // Si el usuario se actualizó correctamente
                // Enviar correo de actualización de perfil
                $emailSender = new Email();
                $emailSender->sendEmail(
                    $request->email,
                    'Actualización de perfil',
                    'Hola ' . $user->name . ', su perfil ha sido actualizado correctamente.'
                );
                return response()->json([
                    'success' => true,
                    'status' => 1,
                    'message' => 'Usuario actualizado correctamente',
                    'data' => $user
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'status' => 0,
                'message' => 'Usuario no encontrado'
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
    public function logout($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->tokens()->delete();
            return response()->json([
                'success' => true,
                'status' => 1,
                'message' => 'Sesión cerrada correctamente'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'status' => 0,
                'message' => 'Usuario no encontrado'
            ]);
        }
    }
}
