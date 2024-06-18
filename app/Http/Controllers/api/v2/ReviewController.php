<?php

namespace App\Http\Controllers\api\v2;

use Exception;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ReviewController extends BaseController
{
    public function index()
    {
        $reviews = DB::table('reviews')->get();
        return $this->sendResponse($reviews,'Reviews found successfully');
    }
public function show($id){

    $review = Review::find($id);
    if($review){
        return $this->sendResponse($review,'Review found successfully');
    }else{
        return $this->sendError('Review not found','Review not found',404);
    }
}
    public function store(Request $request){
        //dd($request->all());
        try{
            $fields = [
                'thumbnail' => 'review/thumbnail',
               
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
            $thumbnailUrl = isset($uploadedFiles['thumbnail']) ? Storage::disk('s3')->url($uploadedFiles['thumbnail']) : null;
    
          
            $review = Review::create([
                'name'=>$request->name,
                'designation'=>$request->designation,
                'review'=>$request->review,
                'thumbnail'=>$thumbnailUrl,
                'videoUrl'=>$request->videoUrl,
            ]);
            
            return $this->sendResponse($review, 'Review created successfully.');
        }catch(Exception $e){

            return $this->sendError('Error', $e->getMessage());
        }
        
       
    }

    public function update(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'designation' => 'nullable',
            'review' => 'required',
            'thumbnail' => 'nullable',
            'videoUrl' => 'nullable',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $review = Review::find($id);

        if(!$review){
            return $this->sendError('Review not found','Review not found',404);
        }

        $fields = [
            'thumbnail' => 'review/thumbnail',
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
        $thumbnailUrl = isset($uploadedFiles['thumbnail']) ? Storage::disk('s3')->url($uploadedFiles['thumbnail']) : null;


        $review->update([
            'name'=>$request->name ?? $review->name,
            'designation'=>$request->designation ?? $review->designation,
            'review'=>$request->review ?? $review->review,
            'thumbnail'=>$thumbnailUrl ?? $review->thumbnail,
            'videoUrl'=>$request->videoUrl ?? $review->videoUrl,
        ]);
        
        return $this->sendResponse($review, 'Review updated successfully.');
    }
    public function destroy($id){

        $review = Review::find($id);
        if($review){
            File::delete(public_path($review->thumbnail));
            File::delete(public_path($review->videoUrl));
            $review->delete();
            return $this->sendResponse($review,'Review deleted successfully');
        }else{
            return $this->sendError('Review not found','Review not found',404);
        }
    }
}
