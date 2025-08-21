<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use DataTables;

class InventoryController extends Controller
{
   public function store(Request $request)
   {

    if($request->submit=='add'){     
       $validator = Validator::make($request->all(), [
        'categoryName' => 'required|string|unique:categories,name',
    ]);
       if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422);
    }
    $inserted = DB::table('categories')->insert([
        'name' => $request->categoryName,
        'status' => 'active',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    if ($inserted) {
        return response()->json([
            'status' => true,
            'message' => 'Category added successfully!'
        ]);
    } else {
        return response()->json([
            'status' => false,
            'message' => 'Failed to add category.'
        ], 500);
    }
}elseif($request->submit=='edit'){
    $validator = Validator::make($request->all(), [
        'categoryName' => 'required|string',
    ]);
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422);
    }
    $currentName = DB::table('categories')
    ->where('id', $request->id)
    ->value('name');
    if ($currentName !== $request->categoryName) {
        $exists = DB::table('categories')
        ->where('name', $request->categoryName)
        ->exists();

        if ($exists) {
            return response()->json([
                'status' => false,
                'message' => 'Category name already exists.'
            ], 422);
        }
    }
    $inserted = DB::table('categories')
    ->where('id', $request->id)
    ->update([
        'name' => $request->categoryName,
        'updated_at' => now(),
    ]);
    if ($inserted) {
        return response()->json([
            'status' => true,
            'message' => 'Category Updated successfully!'
        ]);
    } else {
        return response()->json([
            'status' => false,
            'message' => 'Failed to Edit category.'
        ], 500);
    }
}
}
public function getcategories()
{
    $categories = DB::table('categories')->get();
        // dd($categories);die();
    return view('admin.inventory.addcategory', compact('categories'));
} 
// public function getcategoriesDatatable()
// {
//     $data = DB::table('categories')->select('id', 'name', 'status');
//     return DataTables::of($data)
//     ->addIndexColumn()
//     ->addColumn('action', function($row) {
//         return '<a href="/edit/'.$row->id.'" class="btn btn-sm btn-primary">Edit</a>';
//     })
//     ->rawColumns(['action'])
//     ->make(true);
// }

public function editcategorydetails(Request $request)
{
    $validator = Validator::make($request->all(), [
        'id' => 'required|exists:categories,id',
    ]);
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422);
    }
    $details = DB::table('categories')
    ->where('id', $request->id)
    ->first();
    $html = view('admin.inventory.edit_category_form', compact('details'))->render();
    return response()->json([
        'status' => true,
        'details' => $details,
        'html' => $html
    ]);
}
public function categoryselect2(Request $request)
{
    $search = $request->input('q');
    $categories = DB::table('categories')
    ->where('name', 'LIKE', "%{$search}%")
    ->get(['id', 'name']);
    return response()->json($categories);
}


public function Insertproduct(Request $request)
{
    if($request->submit=='add'){     
       $validator = Validator::make($request->all(), [
        'productname' => 'required|string|unique:products,name',
        'category_id' => 'required|string',
        'stock' => 'required|string',
    ]);
       if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422);
    }
    $inserted = DB::table('products')->insert([
        'name' => $request->productname,
        'category_id' => $request->category_id,
        'stock' => $request->stock,
        'status' => 'active',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    if ($inserted) {
        return response()->json([
            'status' => true,
            'message' => 'Products added successfully!'
        ]);
    } else {
        return response()->json([
            'status' => false,
            'message' => 'Failed to add Products.'
        ], 500);
    }
}elseif($request->submit=='edit'){
    $validator = Validator::make($request->all(), [
        'productname' => 'required|string',
        'category_id' => 'required|string',
        'stock' => 'required|string',
    ]);
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422);
    }
    $currentName = DB::table('products')
    ->where('id', $request->id)
    ->value('name');
    if ($currentName !== $request->productname) {
        $exists = DB::table('products')
        ->where('name', $request->productname)
        ->exists();

        if ($exists) {
            return response()->json([
                'status' => false,
                'message' => 'Product name already exists.'
            ], 422);
        }
    }


    $inserted = DB::table('products')
    ->where('id', $request->id)
    ->update([
       'name' => $request->productname,
       'category_id' => $request->category_id,
       'stock' => $request->stock,
       'updated_at' => now(),
   ]);
    if ($inserted) {
        return response()->json([
            'status' => true,
            'message' => 'Products Updated successfully!'
        ]);
    } else {
        return response()->json([
            'status' => false,
            'message' => 'Failed to Edit Products.'
        ], 500);
    }
}
}
public function getProducts()
{
 $products = DB::table('products as pd')
 ->join('categories as c', 'pd.category_id', '=', 'c.id')
 ->select('pd.*', 'c.name as category_name')
 ->get();
 return view('admin.inventory.addproduct', compact('products'));
}
public function editProductdetails(Request $request)
{
    $validator = Validator::make($request->all(), [
        'id' => 'required|exists:products,id',
    ]);
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422);
    }
    $details = DB::table('products as pd')
    ->where('pd.id', $request->id)
    ->join('categories as c', 'pd.category_id', '=', 'c.id')
    ->select('pd.*', 'c.name as category_name')
    ->first();
    $html = view('admin.inventory.edit_product', compact('details'))->render();
    return response()->json([
        'status' => true,
        'details' => $details,
        'html' => $html
    ]);
}
}
