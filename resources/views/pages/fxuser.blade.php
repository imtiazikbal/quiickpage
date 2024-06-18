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
                <h3>{{ __('Users Verification ')}}</h3>
            </div>
            <div class="card-body">
                <div class="dt-responsive">                  

                    <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>{{ __('SL') }}</th>
                                
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Phone') }}</th>
                                <th>{{ __('MID') }}</th>
                                <th>{{ __('Birthday') }}</th>
                                <th>{{ __('Gender') }}</th>
                                <th>{{ __('Occupation') }}</th>
                                <th>{{ __('Created At') }}</th>
                                 <th>{{ __('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 0)
                            @foreach($users as $single_user)
                            <tr>
                                <td>{{ ++$i }}</td>

                                <td>{{ $single_user->username }}</td>
                                <td>{{ $single_user->email }}</td>
                                <td>{{ $single_user->phone }}</td>
                                <td>{{ $single_user->mid }}</td>
                                
                                <td>{{ \Carbon\Carbon::parse($single_user->dob)->format('d M Y') }}</td>
                                <td>{{ $single_user->gender }}</td>
                                <td>{{ $single_user->occupation }}</td>
                                <td>{{ \Carbon\Carbon::parse($single_user->createdAt)->format('d M Y') }}</td>
                              
                                {{-- <td>{{ $single_user->status }}</td> --}}
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('fxuser', ['id' => $single_user->id]) }}">
                                            <i class="ik ik-denger f-16 mr-15 text-red"></i></a>
                                        <a href="{{ route('fxuser', ['id' => $single_user->id]) }}">
                                        <i class="ik ik-eye f-16 mr-15 text-green"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>{{ __('SL') }}</th>
                                
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Phone') }}</th>
                                <th>{{ __('MID') }}</th>
                                <th>{{ __('Birthday') }}</th>
                                <th>{{ __('Gender') }}</th>
                                <th>{{ __('Occupation') }}</th>
                                <th>{{ __('Created At') }}</th>
                                 <th>{{ __('Action')}}</th>
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
