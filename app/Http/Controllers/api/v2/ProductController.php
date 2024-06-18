<?php

namespace App\Http\Controllers\api\v2;

use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends BaseController
{
    public function index()
    {

        // $products = DB::table('products')
        //                 ->join('categories', 'categories.id', '=', 'products.category_id')
        //                 ->select('products.*', 'categories.name as category_name')
        //                 ->get();
                        
        $product = DB::table('products')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->leftJoin('product_details', 'product_details.product_id', '=', 'products.id')
        ->select(
            'products.*',
            'categories.name as category_name',
            
 // Aggregate if multiple details per product
 // Aggregate if multiple details per product
            DB::raw('GROUP_CONCAT(product_details.gallery) as gallery') // Aggregate gallery images
        )
        ->groupBy('products.id')
        ->get();
                 
             //   return $this->sendResponse( $products,'Products fetched successfully.');
        return view('pages.products',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = DB::table('categories')->get();  
        return view('pages.create_product', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

       
        try {
            // Validate request data
            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'price' => 'required',
               

            ]);
            
            if($validate->fails()){
                return response()->json([
                    'message' => 'Validation error',
                    'errors' => $validate->errors(),
                ], 400);
            }
            $fields = [
                'image' => 'solutions/thumbnail',
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
         
    
            
            
            // Create a new Car record
            $product = Product::create([
                'name' => $request->name,
                'brand' => $request->brand,
                'model' => $request->model,
                'price' => $request->price,
                'image' => $thumbnailUrl,
                'category_id' => $request->category_id,
                'phone' => $request->phone,
                'description' => $request->description,
                'auctionPoint' => $request->auctionPoint,
                'package' => $request->package,
                'keyFeatures' => $request->keyFeatures,
                'color' => $request->color,
            ]);
    
            $product_id = $product->id;
    
            // Handle multiple file uploads for car_gallery
            $multipleImages = $request->file('gallery');

            if ($multipleImages) {
                foreach ($multipleImages as $file) {
                    // Generate a unique file name
                    $imageName = time() . '_' . $file->getClientOriginalName();
    
                    // Upload the file to S3
                    $path = $file->storeAs('product/gallery', $imageName, 's3');
    
                    // Create a new entry in the ProductGallery
                    ProductDetail::create([
                        'product_id' => $product_id,
                        'gallery' => Storage::url($path),
                    ]);
                }
            }
                 
            return $this->sendResponse([$product],'Services Created Successfully'); 
    
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), [], 500);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if(!DB::table('products')->find($id)){
            return $this->sendError('Product not found', [], 404);
        }
        $product = DB::table('products')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->leftJoin('product_details', 'product_details.product_id', '=', 'products.id')
        ->where('products.id', $id)
        ->select(
            'products.*',
            'categories.name as category_name',
            DB::raw('GROUP_CONCAT(product_details.gallery) as gallery') // Aggregate gallery images
        )
        ->groupBy('products.id')
        ->first();
    if ($product) {
        // Assuming `gallery` is a comma-separated list of multiple image paths
        $product->gallery = explode(',', $product->gallery);
    }
    
    
   
    return $this->sendResponse($product,'Single product details successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
        $product = DB::table('products')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->leftJoin('product_details', 'product_details.product_id', '=', 'products.id')
        ->where('products.id', $id)
        ->select(
            'products.*',
            'categories.name as category_name',
            
 // Aggregate if multiple details per product
 // Aggregate if multiple details per product
            DB::raw('GROUP_CONCAT(product_details.gallery) as gallery') // Aggregate gallery images
        )
        ->groupBy('products.id')
        ->first();
    
    // Process the gallery images
    if ($product) {
        // Assuming `gallery` is a comma-separated list of multiple image paths
        $product->gallery = explode(',', $product->gallery);
    }
    
    
   
        
                     // return $product;

        $categories = DB::table('categories')->get();  

        return view('pages.edit_product',compact('product','categories'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {

        $product = Product::where('id',$id)->first();
        if(!$product){
            return $this->sendError('Product not found.');
        }
        
        $fields = [
            'image' => 'solutions/thumbnail',
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
     
        $product = Product::where('id',$id)->first();
        
        // Create a new Car record
         Product::where('id', $id)->update([
            'name' => $request->name,
            'brand' => $request->brand,
            'model' => $request->model,
            'price' => $request->price,
            'image' => $thumbnailUrl ?? $product->image,
            'category_id' => $request->category_id,
            'phone' => $request->phone,
            'description' => $request->description,
            'auctionPoint' => $request->auctionPoint,
            'package' => $request->package,
            'keyFeatures' => $request->keyFeatures,
            'color' => $request->color,
        ]);

       

        // Handle multiple file uploads for car_gallery
       

       

        $multipleImages = $request->file('gallery'); // 'file' method used to handle file uploads

        if ($multipleImages) {
            foreach ($multipleImages as $file) {
                // Generate a unique file name
                $imageName = time() . '_' . $file->getClientOriginalName();

                // Upload the file to S3
                $path = $file->storeAs('product/gallery', $imageName, 's3');

                // Create a new entry in the ProductGallery
                ProductDetail::create([
                    'product_id' => $id,
                    'gallery' => $path,
                ]);
            }
        }
        return $this->sendResponse('Prduct Upate Successfully','Prduct Upate Successfully');
        
    }        

      
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        // Begin a transaction
        DB::beginTransaction();

        try {
            // Retrieve product and associated gallery images
            $product = Product::findOrFail($id);
            if(!$product){
                return $this->sendError('Error', 'Product not found.');
            }
            $galleryImages = ProductDetail::where('product_id', $product->id)->get();
           
            // Delete product thumbnail and other associated files
            File::delete($product->image);

           
            // Delete gallery images and associated records
            foreach ($galleryImages as $image) {
                File::delete($image->gallery);
                $image->delete();
            }

            // Finally, delete the product itself
            $product->delete();

            // Commit the transaction
            DB::commit();
            // Return success response
            return $this->sendResponse('Delete', 'Product deleted successfully.');
        } catch (Exception $e) {
            // Something went wrong, rollback the transaction
            DB::rollBack();
            // Log the error or handle it appropriately
            return $this->sendError('Error', 'Failed to delete product: ' . $e->getMessage());
        }

    }
}
