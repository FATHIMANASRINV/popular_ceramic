<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;   
use DataTables;

class SignupController extends Controller
{
    public function SignupForm(Request $request)
    {
     $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|unique:users,email',
        'password' => 'required',
    ]);
     if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422);
    }
    $inserted = DB::table('users')->insert([
        'name' => $request->name,
        'email' => $request->email,
        'password'   => Hash::make($request->password), 
        'user_type' => $request->user_type,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    if ($inserted) {
        return response()->json([
            'status' => true,
            'message' => 'Registered  successfully!'
        ]);
    } else {
        return response()->json([
            'status' => false,
            'message' => 'Failed to Registering.'
        ], 500);
    }
}
}
