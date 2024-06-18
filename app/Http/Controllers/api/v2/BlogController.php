<?php

namespace App\Http\Controllers\api\v2;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BlogController extends BaseController
{
    public function index()
    {
        return $this->sendResponse(Blog::all(), 'Blog fetched successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

      
        $validator = Validator::make($request->all(), [
            'thumbnail' => 'nullable',
            'title' => 'required',
            'description' => 'nullable',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $fields = [
            'thumbnail' => 'blog/thum',
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

        $thumbnailUrl = isset($uploadedFiles['thumbnail']) ? Storage::disk('s3')->url($uploadedFiles['thumbnail']) : null;
        $data = Blog::create([
            'title' => $request->title,
            'thumbnail' => $thumbnailUrl,
            'description' => $request->description,
        ]);

        return $this->sendResponse($data, 'Blog created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $blog = Blog::find($id);
        if (!$blog) {
            return $this->sendError('Blog not found.');
        } else {
            return $this->sendResponse($blog, 'Blog retrieved successfully.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function updateStatus(Request $request,$id)
    {
        $blog = Blog::find($id);
        if (!$blog) {
            return $this->sendError('Blog not found.');
        } else {
            $data = Blog::find($id)->update([
                'status' => $request->status,
            ]);
            return $this->sendResponse($blog, 'Blog updated successfully.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'thumbnail' => 'nullable',
            'title' => 'nullable',
            'description' => 'nullable',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $fields = [
            'thumbnail' => 'blog/thum',
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
        // delete old file from s3
        $blog = Blog::find($id);
        // Check if the file exists on S3 and delete it
        if ($fileUrl = $blog->thumbnail) {
            $filePath = parse_url($fileUrl, PHP_URL_PATH);
            $filePath = ltrim($filePath, '/');
            // Check if the file exists on S3 and delete it
            Storage::disk('s3')->delete($filePath);
        }
        $thumbnailUrl = isset($uploadedFiles['thumbnail']) ? Storage::disk('s3')->url($uploadedFiles['thumbnail']) : null;
        $data = Blog::find($id)->update([
            'title' => $request->title,
            'thumbnail' => $thumbnailUrl ?? $blog->thumbnail,
            'description' => $request->description ?? $blog->description,
        ]);

        return $this->sendResponse($data, 'Blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $quote = Blog::find($id);

        // Check if the quote exists
        if (!$quote) {
            return $this->sendError('Blog not found.');
        }

        if ($fileUrl = $quote->thumbnail) {
            $filePath = parse_url($fileUrl, PHP_URL_PATH);
            $filePath = ltrim($filePath, '/');
            // Check if the file exists on S3 and delete it
            Storage::disk('s3')->delete($filePath);
            $quote->delete();
            return $this->sendResponse('Blog deleted', 'Blog deleted successfully.');
        } else {
            $quote->delete();
            return $this->sendResponse('Blog deleted', 'Blog deleted successfully.');
        }
    }
}
