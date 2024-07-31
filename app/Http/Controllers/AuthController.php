<?php
  
namespace App\Http\Controllers;
  
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\Teachers;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class AuthController extends Controller
{
 
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(StoreUserRequest $request)
    {
        try {
            // $user = new User;
            // $user->username = $request->username;
            // $user->email = $request->email;
            // $user->password = bcrypt($request->password);
            // $user->ulang_password = $request->ulang_password;
            // $user->role = $request->role;
            // $user->save();

            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'ulang_password' => $request->ulang_password,
                'role' => $request->role,
            ]);
     
            return response()->json([
                'message' => 'User successfully registered',
                'user' => $user
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create user'], 500);
        }
    }
    
    public function registerAsTeacher(StoreTeacherRequest $request) 
    {
        DB::beginTransaction();

        try {
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'ulang_password' => $request->ulang_password,
                'role' => $request->role,
            ]);

            $teacher = Teachers::create([
                'name' => $request->name,
                'nuptk' => $request->nuptk,
                'user_id' => $user->id,
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Teacher successfully registered',
                'teacher' => $teacher
            ], 201);
            
        } catch (\Throwable $th) {
            
        }
    }
  
  
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Invalid email or password.'], 401);
        }
    
        return $this->respondWithToken($token);
    }
  
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }
  
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
  
        return response()->json(['message' => 'Successfully logged out']);
    }
  
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
  
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 1440 
            // 'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}