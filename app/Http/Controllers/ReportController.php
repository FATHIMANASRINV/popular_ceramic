<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;   
use DataTables;
use Illuminate\Http\Request;

class ReportController extends Controller
{
   public function getstaff_details(Request $request)
   {
      $query  = DB::table('users as pd')
      ->where('pd.user_type','staff')
      ->select('pd.*');
      if ($request->filled('user_id')) {
        $query->where('pd.id', $request->user_id);
    }
    $user_details = $query->get();
    return view('admin.report.staff_details', compact('user_details'));
}
public function usersEmailselect2(Request $request)
{
    $search = $request->input('q');
    $users = DB::table('users')
    ->where('name', 'LIKE', "%{$search}%")
    ->orWhere('email', 'LIKE', "%{$search}%")
    ->get(['id', 'email as name']);
    return response()->json($users);
}
}
