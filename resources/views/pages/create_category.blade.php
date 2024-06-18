@extends('layouts.main')
@section('title', 'Create Category')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    @endpush
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-inbox bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Data Table') }}</h5>
                            <span>{{ __('lorem ipsum dolor sit amet, consectetur adipisicing elit') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Tables</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Data Table</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="card p-4">
                    <form action="{{ route('category.store') }}" method="POST" id="save-form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Category Name Input -->
                            <div class="col-md-8 mb-3">
                                <div class="form-group">
                                    <label for="category-name"> {{ __('Category Name') }}</label>
                                    <input type="text" name="name" id="category-name" class="form-control form-control-lg"
                                           required>
                                    @if ($errors->has('name'))
                                        <div class="error mt-2 text-danger">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>
        
                            <!-- Category Image Input and Preview -->
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="category-image"> {{ __('Category Image') }}</label>
                                    <input type="file" id="image" name="image" accept="image/*" class="form-control"
                                           onchange="showImagePreview(this)">
                                </div>
                                <div class="preview-container">
                                    <img id="preview" src="" alt="Image Preview" class="img-fluid">
                                </div>
                            </div>
                        </div>
        
                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-theme px-10">{{ __('Submit') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <style>
            .preview-container {
                text-align: center;
                margin-top: 20px;
            }
        
            .preview-container img {
                max-width: 150px;
                height: auto;
                border: 2px solid #ddd;
                padding: 5px;
                border-radius: 5px;
            }
        
            .btn-theme {
                background-color: #007bff; /* Customize button color */
                color: #fff;
                border: none;
            }
        
            .btn-theme:hover {
                background-color: #0056b3; /* Customize button hover color */
            }
        </style>
        


    <script>
        function showImagePreview(input) {
            let file = input.files[0]; // Get the first file selected
            if (file && file.type.startsWith('image/')) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let previewImage = document.getElementById('preview');
                    previewImage.src = e.target.result; // Set the image source to the file's data URL
                    previewImage.style.display = 'block'; // Ensure the image is displayed
                }
                reader.readAsDataURL(file); // Read the image file as a data URL
            } else {
                console.warn('Selected file is not an image or no file selected.');
            }
        }
    </script>


    <!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('js/datatables.js') }}"></script>
    @endpush
@endsection
