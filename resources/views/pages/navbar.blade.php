@extends('layouts.main') 
@section('title', 'Navbar')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/weather-icons/css/weather-icons.min.css') }}">
    @endpush

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-menu bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Navbar') }}</h5>
                            <span>{{ __('lorem ipsum dolor sit amet, consectetur adipisicing elit') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Navbar') }}</li>
                        </ol>
                    </nav>
                </div>

                
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ __('Header Color') }}</h3>
                    </div>
                    <div class="card-body">
                        <h4 class="sub-title">header-theme="light"</h4>
                        <p class="mb-10">Add <code>header-theme="light"</code> attribute in <code>.header-top</code> class</p>
                        <img src="../img/navbar/light.jpg" class="img-fluid border p-1 rounded" alt="">

                        <h4 class="sub-title mt-30">header-theme="dark"</h4>
                        <p class="mb-10">Add <code>header-theme="dark"</code> attribute in <code>.header-top</code> class</p>
                        <img src="../img/navbar/dark.jpg" class="img-fluid border p-1 rounded" alt="">

                        <h4 class="sub-title mt-30">header-theme="blue"</h4>
                        <p class="mb-10">Add <code>header-theme="blue"</code> attribute in <code>.header-top</code> class</p>
                        <img src="../img/navbar/blue.jpg" class="img-fluid border p-1 rounded" alt="">

                        <h4 class="sub-title mt-30">header-theme="red"</h4>
                        <p class="mb-10">Add <code>header-theme="red"</code> attribute in <code>.header-top</code> class</p>
                        <img src="../img/navbar/red.jpg" class="img-fluid border p-1 rounded" alt="">

                        <h4 class="sub-title mt-30">header-theme="orange"</h4>
                        <p class="mb-10">Add <code>header-theme="orange"</code> attribute in <code>.header-top</code> class</p>
                        <img src="../img/navbar/orange.jpg" class="img-fluid border p-1 rounded" alt="">

                        <h4 class="sub-title mt-30">header-theme="green"</h4>
                        <p class="mb-10">Add <code>header-theme="green"</code> attribute in <code>.header-top</code> class</p>
                        <img src="../img/navbar/green.jpg" class="img-fluid border p-1 rounded" alt="">

                        <h4 class="sub-title mt-30">header-theme="purple"</h4>
                        <p class="mb-10">Add <code>header-theme="purple"</code> attribute in <code>.header-top</code> class</p>
                        <img src="../img/navbar/purple.jpg" class="img-fluid border p-1 rounded" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
      
        
        

