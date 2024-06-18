<?php

namespace App\Http\Controllers\api\v2;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends BaseController
{
    public function index()
    {
    

    $products = DB::table('products')
    ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
    ->leftJoin('product_details', 'product_details.product_id', '=', 'products.id')
    ->select(
        'products.*', // Select all columns from products
        'categories.name as category_name', // Select category name
        'categories.image as category_image', // Select category image
        DB::raw('GROUP_CONCAT(product_details.gallery SEPARATOR ",") as gallery') // Concatenate gallery images
    )
    ->groupBy('products.id') // Group by product ID
    ->get();

// Process the data to transform the gallery field into an array
$processedProducts = $products->map(function ($product) {
    // Convert the gallery string into an array
    $product->gallery = explode(',', $product->gallery);
    
    // Optionally, clean up whitespace or other characters
    $product->gallery = array_map('trim', $product->gallery);

    return $product;
});

// Convert to array if needed for JSON response
$productsArray = $processedProducts->toArray();

                    return $this->sendResponse($productsArray,'All products with categor');

                    
    }

    public function singleCatProduct(Request $request){
        $catName = request()->query('catName');
        $catId = DB::table('categories')->where('name',$catName)->select('id')->first();

        $products = DB::table('products')
                     ->leftJoin('categories', 'categories.id', '=', 'products.category_id')
                     ->leftJoin('product_details', 'product_details.product_id', '=', 'products.id')
                     ->select(
                        'products.*',
                        'categories.name as category_name',
                        'categories.image as category_image',
                        DB::raw('GROUP_CONCAT(product_details.gallery) as gallery'))
                    ->where('products.category_id',$catId->id)
                    ->groupBy('products.id')
                    ->get();
                    return $this->sendResponse($products,'All products with categor');
        }
}
