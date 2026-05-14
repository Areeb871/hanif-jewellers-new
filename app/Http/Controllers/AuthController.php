<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller
{
    public function login(){
        try {
            if(isset(Auth::user()->id)){
                return redirect()->intended('/admin/dashboard');
            }else{
                return view('login');
            }
        } catch (\Throwable $th) {
            return response()->json([ 'message' => 'SOMETHING WENT WRONG','error' => $th->getMessage() ], 500);
        }
    }
    public function register(){
        try {
            if(isset(Auth::user()->id)){
                return redirect()->intended('/admin/dashboard');
            }else{
                return view('register');
            }
        } catch (\Throwable $th) {
            return response()->json([ 'message' => 'SOMETHING WENT WRONG','error' => $th->getMessage() ], 500);
        }
    }
    public function registerUser(Request $request){
        try {
            $request->validate([
                'email' => 'required|string|email|unique:users',
                'password' => 'required|string|min:6'
            ]);
        
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        
            return response()->json([
                'message'=>'Registered Successfully', 
            ]);
        } catch (\Throwable $th) {
            return response()->json([ 'message' => 'SOMETHING WENT WRONG','error' => $th->getMessage() ], 500);
        }
    }

    public function loginUser(Request $request){
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('/admin/dashboard');
            }
        
            return response()->json(['message' => 'Authentication failed'], 401);
        } catch (\Throwable $th) {
            return response()->json([ 'message' => 'SOMETHING WENT WRONG','error' => $th->getMessage() ], 500);
        }
    }

    public function logout(Request $request){
        try{
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->intended('/');
        } catch (\Throwable $th) {
            return response()->json([ 'message' => 'SOMETHING WENT WRONG','error' => $th->getMessage() ], 500);
        }
    }
}
