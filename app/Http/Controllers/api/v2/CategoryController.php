<?php

namespace App\Http\Controllers\api\v2;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    
    {
        $categories = DB::table('categories')
    ->select('id as category_id', 'name', 'image')
    ->get();


        
       return $this->sendResponse($categories,'Categories fetched successfully.');
        //return view('pages.categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.create_category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            //dd($request->all());
        $fields = [
            'image' => 'product/thumbnail',
        ];        
        $uploadedFiles = [];

        foreach ($fields as $field => $path) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                // Store the file in the specified path on S3 with its original name
                $uploadedPath = $file->store($path, 's3');
                // Store the file path for later use
                $uploadedFiles[$field] = $uploadedPath;
            }
        }
      

        // Now you have all the URLs in the $uploadedFiles array
        $thumbnailUrl = isset($uploadedFiles['image']) ? Storage::disk('s3')->url($uploadedFiles['image']) : null;
     
        $response =  Category::create([
            'name' => $request->name,
            'image' =>$thumbnailUrl
        ]);
return $this->sendResponse($response,'Category created successfully.');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {        
        $category = Category::where('id',$id)->first();
        if(!$category){
            return $this->sendError('Category not found.');
        }
        File::delete(public_path($category->image));
        $category->delete();
        return $this->sendResponse('category deleted','Category created successfully.');
    }

    public function solutions(Request $request){

        $solutions = DB::table('products')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->select(
            'categories.name as category_name',
            'products.id as id',
            'products.name as name',
            'products.image as image'
        )
        ->get();
    
    // Initialize an array to hold the grouped data
    $groupedSolutions = [];
    
    // Group the solutions by category
    foreach ($solutions as $solution) {
        // Check if the category already exists in the grouped array
        if (!isset($groupedSolutions[$solution->category_name])) {
            // Initialize the category in the grouped array with an empty solutions array
            $groupedSolutions[$solution->category_name] = [
                'category_name' => $solution->category_name,
                'solutions' => [],
            ];
        }
        
        // Add the product to the appropriate category's solutions array
        $groupedSolutions[$solution->category_name]['solutions'][] = [
            'id' => $solution->id,
            'image' => $solution->image,
            'name' => $solution->name,
        ];
    }
    
    // Convert the grouped solutions to a numerical index array
    // Convert the grouped solutions to a numerical index array
    $groupedSolutions = array_values($groupedSolutions);
    return $this->sendResponse($groupedSolutions,'Categories solutions');
    }
}
