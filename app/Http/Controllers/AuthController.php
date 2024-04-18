<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\ValidationException as ValidationValidationException;
use stdClass;

use function PHPUnit\Framework\isEmpty;

class AuthController extends Controller
{
    public function register(Request $request){

        try {
            $data = $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|unique:users',
                'password' => 'required|string'
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['message' => 'Usuario registrado exitosamente'], 201);

        } catch (ValidationValidationException $error) {
            return response()->json(['errors' => $error->errors()], 422);
        }
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Contraseña incorrecta acceso denegado'], 401);
        }
        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => "Hi $user->name",
            'accesToken' => $token,
            'tokenType' => 'Bearer',
            'user' => $user
        ]);

    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();
        return ['message' => 'You hace successfully logged out and the token was successfully deleted'];
    }
}
