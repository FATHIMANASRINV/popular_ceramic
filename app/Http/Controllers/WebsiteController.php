<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Website;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

use DataTables;

class WebsiteController extends Controller
{
    public function getWebsiteIndexDetails()
    {
     $totalProducts = DB::table('products')->count();
     $categories = DB::table('categories')->get();
     $totalProductsDetails =   DB::table('products as pd')
     ->join('categories as c', 'pd.category_id', '=', 'c.id')
     ->select('pd.*', 'c.name as category_name')
     ->get();
     $lowStock = DB::table('products')->where('stock', '<', 5)->count();
     $inStock = DB::table('products')->where('stock', '>', 0)->count();
     $outOfStock = DB::table('products')->where('stock', '=', 0)->count();
     return view('website.index', compact(
        'totalProducts',
        'lowStock',
        'inStock',
        'outOfStock',
        'totalProductsDetails',
        'categories'
    ));
 } 
  public function exportWebsiteIndexPdf()
    {
        $totalProducts = DB::table('products')->count();
        $categories = DB::table('categories')->get();
        $totalProductsDetails = DB::table('products as pd')
            ->join('categories as c', 'pd.category_id', '=', 'c.id')
            ->select('pd.*', 'c.name as category_name')
            ->get();
        $lowStock = DB::table('products')->where('stock', '<', 5)->count();
        $inStock = DB::table('products')->where('stock', '>', 0)->count();
        $outOfStock = DB::table('products')->where('stock', '=', 0)->count();
        $pdf = Pdf::loadView('website.index', compact(
            'totalProducts',
            'lowStock',
            'inStock',
            'outOfStock',
            'totalProductsDetails',
            'categories'
        ));

        return $pdf->download('website-dashboard.pdf');
    }
}
