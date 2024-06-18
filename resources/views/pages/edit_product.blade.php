@extends('layouts.main')
@section('title', 'Create Product')
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
                <div class="card">
                    <form action="{{ route('product.update', $product->id) }}" method="POST" id="save-form" enctype="multipart/form-data">
                       @csrf
                        <div class="row pt-md-4">
                            <div class="col-md-8 px-sm-5">


                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="colFormLabel"> {{ __('Category') }}</label>
                                        <select name="category_id" class="form-control form-control-lg form_check_color_right">
                                            <option value="" selected disabled>Select Category</option>
                                            @foreach($categories as $category)
                                                <option {{ $product->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                             @endforeach 
                                        </select>
                                    </div>
                                    @if ($errors->has('name'))
                                        <div class="error mt-2 text-danger">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>


                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="colFormLabel"> {{ __('Title') }}</label>
                                        <input type="text" name="name" id="title" value="{{ $product->name }}" id="colFormLabel"
                                            class="form-control form-control-lg form_check_color_right" required>
                                    </div>
                                    @if ($errors->has('name'))
                                        <div class="error mt-2 text-danger">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="colFormLabel"> {{ __('Price') }}</label>
                                        <input type="text" name="price" id="title" value="{{ $product->price }}" id="colFormLabel"
                                            class="form-control form-control-lg form_check_color_right" required>
                                    </div>
                                    @if ($errors->has('price'))
                                        <div class="error mt-2 text-danger">{{ $errors->first('price') }}</div>
                                    @endif
                                </div>


                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="colFormLabel"> {{ __('Brand') }}</label>
                                        <input type="text" name="brand" id="title" value="{{ $product->brand }}"
                                            id="colFormLabel" class="form-control form-control-lg form_check_color_right"
                                            required>
                                    </div>
                                    @if ($errors->has('range'))
                                        <div class="error mt-2 text-danger">{{ $errors->first('range') }}</div>
                                    @endif
                                </div>



                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="colFormLabel"> {{ __('Model') }}</label>
                                        <input type="text" name="model" id="title" value="{{ $product->model }}"
                                            id="colFormLabel" class="form-control form-control-lg form_check_color_right"
                                            required>
                                    </div>
                                    @if ($errors->has('powerBy'))
                                        <div class="error mt-2 text-danger">{{ $errors->first('powerBy') }}</div>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="colFormLabel"> {{ __('auctionPoint') }}</label>
                                        <input type="text" name="auctionPoint" id="title"
                                            value="{{ $product->auctionPoint }}" id="colFormLabel"
                                            class="form-control form-control-lg form_check_color_right" required>
                                    </div>
                                    @if ($errors->has('phone'))
                                        <div class="error mt-2 text-danger">{{ $errors->first('phone') }}</div>
                                    @endif
                                </div>


                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="colFormLabel"> {{ __('package') }}</label>
                                        <input type="text" name="package" id="title"
                                            value="{{ $product->package }}" id="colFormLabel"
                                            class="form-control form-control-lg form_check_color_right" required>
                                    </div>
                                    @if ($errors->has('description'))
                                        <div class="error mt-2 text-danger">{{ $errors->first('description') }}</div>
                                    @endif
                                </div>


                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="colFormLabel"> {{ __('keyFeatures') }}</label>
                                        <input type="text" name="keyFeatures" id="title"
                                            value="{{ $product->keyFeatures }}" id="colFormLabel"
                                            class="form-control form-control-lg form_check_color_right" required>
                                    </div>
                                    @if ($errors->has('description'))
                                        <div class="error mt-2 text-danger">{{ $errors->first('description') }}</div>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="colFormLabel"> {{ __('Color') }}</label>
                                        <input type="text" name="color" id="title"
                                            value="{{ $product->color }}" id="colFormLabel"
                                            class="form-control form-control-lg form_check_color_right" required>
                                    </div>
                                    @if ($errors->has('description'))
                                        <div class="error mt-2 text-danger">{{ $errors->first('description') }}</div>
                                    @endif
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="colFormLabel"> {{ __('Phone') }}</label>
                                        <input type="text" name="phone" id="title" value="{{ $product->phone }}" id="colFormLabel"
                                            class="form-control form-control-lg form_check_color_right" required>
                                    </div>
                                    @if ($errors->has('phone'))
                                        <div class="error mt-2 text-danger">{{ $errors->first('phone') }}</div>
                                    @endif
                                </div>


                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label for="colFormLabel"> {{ __('Description') }}</label>
                                        <input type="text" name="description" id="title" value="{{ $product->description }}" id="colFormLabel"
                                            class="form-control form-control-lg form_check_color_right" required>
                                    </div>
                                    @if ($errors->has('description'))
                                        <div class="error mt-2 text-danger">{{ $errors->first('description') }}</div>
                                    @endif
                                </div>





                            </div>

                            <div class="col-md-4">



                                <label for="colFormLabel"> {{ __('Car Thumbnail') }}</label>

                                <div class="form-group">

                                    <input type="file" id="image" name="image" accept="image/*"
                                        onchange="showImagePreview(this)">
                                </div>
                                <div class="preview-container">
                                    <img id="preview" src="{{ asset($product->image) }}" alt="Image Preview" class="img-fluid">
                                </div>
                                <label for="colFormLabel"> {{ __('Description') }}</label>

                                <input type="file" id="image-input" name="gallery[]" multiple accept="image/*">
                                <div class="image-preview" id="image-preview">
                                  
                                
                                    @if(is_array($product->gallery))
                                        @foreach($product->gallery as $image)
                                            <img src="{{ asset($image) }}" alt="Image Preview" class="img-fluid">
                                        @endforeach
                                    @else
                                        <p>No images available.</p>
                                    @endif
                                </div>
                                
                                
                                <style>
                                    .image-preview {
                                        display: flex;
                                        flex-wrap: wrap;
                                        gap: 10px;
                                        margin-top: 10px;
                                    }

                                    .image-preview img {
                                        max-width: 100px;
                                        height: auto;
                                        border: 2px solid #ddd;
                                        padding: 5px;
                                        border-radius: 5px;
                                    }

                                    .preview-container {
                                        text-align: center;
                                        margin-top: 20px;
                                    }

                                    .preview-container img {
                                        max-width: 100px;
                                        height: auto;
                                        border: 2px solid #ddd;
                                        padding: 5px;
                                        border-radius: 5px;
                                        margin-top: 10px;
                                    }
                                </style>
                                <script>
                                    document.getElementById('image-input').addEventListener('change', function(event) {
                                        let files = event.target.files;
                                        let previewContainer = document.getElementById('image-preview');
                                        previewContainer.innerHTML = ''; // Clear previous previews

                                        if (files) {
                                            Array.from(files).forEach(file => {
                                                if (file.type.startsWith('image/')) { // Check if the file is an image
                                                    let reader = new FileReader();
                                                    reader.onload = function(e) {
                                                        let img = document.createElement('img');
                                                        img.src = e.target.result;
                                                        previewContainer.appendChild(img);
                                                    }
                                                    reader.readAsDataURL(file);
                                                } else {
                                                    console.warn('File is not an image:', file);
                                                }
                                            });
                                        }
                                    });

                                    /*show image script */
                                    function showImagePreview(input) {
                                        const file = input.files[0];
                                        if (file && file.type.match('image.*')) {
                                            const reader = new FileReader();
                                            reader.onload = function(e) {
                                                document.getElementById('preview').src = e.target.result;
                                            }
                                            reader.readAsDataURL(file);
                                        } else {
                                            document.getElementById('preview').src = '';
                                        }
                                    }
                                </script>
                        <button type="submit" class="btn btn-theme px-10">{{ __('Submit') }}</button>

                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('js/datatables.js') }}"></script>
    @endpush
@endsection
