@extends('layouts.main') 
@section('title', 'Dashboard')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
 
        <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/weather-icons/css/weather-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/jvectormap/jquery-jvectormap.css') }}">
    @endpush

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
            
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Dashboard')}}</a>
                            </li>

                            {{-- <li class="breadcrumb-item active" aria-current="page">{{ __('Widgets Basic')}}</li> --}}
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header d-block">
                <h3>{{ __('Users Symtoms Data')}}</h3>
            </div>
            <div class="card-body">
                <div class="dt-responsive">
                    <table id="multi-colum-dt"
                           class="table table-striped table-bordered nowrap">
                        <thead>
                    
                        <tr>
                            <th>{{ __('SL')}}</th>
                            <th>{{ __('User')}}</th>
                            <th>{{ __('Symptoms')}}</th>
                            <th>{{ __('Created Date')}}</th>
                        </tr>
                      
                        </thead>
                        
                        <tbody>
                 @php( $i = 0 )        
                    @foreach($symptomData as $single_user)    
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$single_user->name}}</td>
                            <td>{{$single_user->symptomValues}}</td>
                            <td>{{ \Carbon\Carbon::parse($single_user->UpdatedAt)->format('d M Y') }}</td>
                          
                        </tr>

                    @endforeach  

                    </tbody>
                        <tfoot>
                            <tr>
                                <th>{{ __('SL')}}</th>
                                <th>{{ __('User')}}</th>
                                <th>{{ __('Symptoms')}}</th>
                                <th>{{ __('Created Date')}}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>


 


    
    </div>
              
    <!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/moment/moment.js') }}"></script>
        <script src="{{ asset('plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js') }}"></script>
        <script src="{{ asset('plugins/jvectormap/jquery-jvectormap.min.js') }}"></script>
        <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
        <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('js/datatables.js') }}"></script>
       
        <script src="{{ asset('js/widgets.js') }}"></script>
    @endpush
@endsection