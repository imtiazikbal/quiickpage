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
                                <th>{{ __('User ID') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('User Name') }}</th>
                                <th>{{ __('Phone') }}</th>
                                <th>{{ __('Selfie') }}</th>
                                <th>{{ __('photoid') }}</th>
                                <th>{{ __('isVerified') }}</th>
                                <th>{{ __('profileTag') }}</th>
                                <th>{{ __('Created At') }}</th>
                                <th>{{ __('Updated At') }}</th>
                                <th>{{ __('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i = 0)
                            @foreach($users as $single_user)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $single_user->id }}</td>
                                <td>{{ $single_user->name }}</td>
                                <td>{{ $single_user->username }}</td>
                                <td>{{ $single_user->phone }}</td>
                                <td> <img style="width: 20px; height: auto" src="{{url($single_user->images)}}">
                                <td> <img style="width: 20px; height: auto" src="{{url($single_user->photoId)}}">
                                <td>{{ $single_user->isVerified }}</td>
                                <td>{{ $single_user->profileTag }}</td>
                                <td>{{ \Carbon\Carbon::parse($single_user->createdAt)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($single_user->updatedAt)->format('d M Y') }}</td>
                                {{-- <td>{{ \Carbon\Carbon::parse($single_user->startDate)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($single_user->endDate)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($single_user->createdAt)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($single_user->updatedAt)->format('d M Y') }}</td> --}}
                                {{-- <td> <img style="width: 20px; height: auto" src="{{url($single_user->images.'.jpg')}}"> --}}
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('verifyuser', ['id' => $single_user->id]) }}">
                                        <i class="ik ik-eye f-16 mr-15 text-green"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>{{ __('SL') }}</th>
                                <th>{{ __('User ID') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('User Name') }}</th>
                                <th>{{ __('Phone') }}</th>
                                <th>{{ __('Selfie') }}</th>
                                <th>{{ __('photoid') }}</th>
                                <th>{{ __('isVerified') }}</th>
                                <th>{{ __('profileTag') }}</th>
                                <th>{{ __('Created At') }}</th>
                                <th>{{ __('Updated At') }}</th>
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
