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

        
        {{-- <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget bg-primary">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>{{ __('Total Users')}}</h6>
                                <h2> {{ count($users) }}</h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget bg-success">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>{{ __('Android')}}</h6>
                                <h2>{{ $androidcount }}</h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-smartphone"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget bg-warning">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>{{ __('Apple')}}</h6>
                                <h2>{{ $ioscount }}</h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-tablet"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget bg-danger">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>{{ __('New Users')}}</h6>
                                <h2> {{ count($users) }}</h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        


        <br>

                <div class="card ">   
                    <div class="card-body">                     
                      
                       
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-home pr-1"></i> Send</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-thumbtack pr-1"></i> History</a>
                            </li>                            
                        </ul>

                        <br>


                        <div class="tab-content" id="myTabContent">
                            <!-- <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="dashboard"> -->
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <form  method = "POST" enctype="multipart/form-data" action = "{{ route('notification.post') }}">

                                    <div class="row">
                                    <div class="col-md-6 ">
                                        <div class = "form-group">
                                            <label for="selected_user">Select User</label>
                                                <select name="selected_user" id="selected_user" class = "form-control">
                                                    <option value="">Choose</option>
                                                    <option value="all_user_panel">All Users</option>
                                                    <option value="specific_user_panel">Specific User</option>
                                                </select>
                                        </div>

                                        <div class = "form-group">
                                            <label for="selected_user" class = "w-100">User Condition</label>
                                                <div class="">
                                                    <div class="">
                                                        <select name="condition_one" class = "all_user_panel form-control toggle-panels parse-user-count" disabled >
                                                            <option value="">All User</option>
                                                            <option value="active_user">Active User</option>
                                                            <option value="active_user_no_order">Active User No Order</option>
                                                            <option value="in_active_user">Inactive User</option>
                                                            <option value="paying_user">Paying User</option>                                                              
                                                        </select>
                                                    </div> <br>
                                                    <div class="">
                                                        <select name="condition_two" class = "all_user_panel form-control toggle-panels parse-user-count" disabled >
                                                            <option value="">Since Beginning</option>
                                                            <option value="1">Today</option>
                                                            <option value="7">In last 7 days</option>
                                                            <option value="30">In last 1 months</option>
                                                            <option value="90">In last 3 months</option>
                                                        </select>
                                                    </div>
                                                </div>
                                        </div>

                                        <div class = "form-group">
                                            <label for="specific_user_panel">Select Customer</label>
                                                <input name="specific_user_data" id = "specific_user_panel" type="text" class = "specific_user_panel form-control parse-user-count toggle-panels"
                                                            placeholder = "ID/Mobile Number" disabled />
                                        </div>


                                        <div class = "form-group">
                                            <label for="schedule_datetime">Schedule Time</label>
                                            <input type="date" name ="schedule_datetime" id = "schedule_datetime" class = "form-control" />
                                        </div>

                                        
                                    </div>


                                    <div class="col-md-6 ">
                                        <label for="title">Title</label>
                                        <input required type="text" name = "title" id = "title" class = "form-control mb-2" placeholder = "Title" />

                                        <label for="body">Body</label>
                                        <textarea required name="message" id="body" rows="5" placeholder = "Message Body" class = "form-control mb-2" ></textarea>

                                        <label for="image">Image URL</label>							
                                        <input type="file" name="image" id="image" class="dropify" data-default-file="" />

                                        @csrf
                                        <input type="submit" class = "btn btn-primary mt-2">
                                    </div>
                                    </div>

                                </form>
                            </div>


                            <!-- <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history"> -->
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class = "p-20">
                                        
                                        <table class="table table-bordered table-striped no-footer mt-4" id = "notifications-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>User type</th>
                                                    <th>User Condition Parent</th>
                                                    <th>User Condition Child</th>
                                                    <th>Selective Customer</th>
                                                    <th>Zone</th>
                                                    <th>Title</th>
                                                    <th>Body</th>
                                                    <th>Image</th>
                                                    <th>User</th>
                                                    <th>Schedule time</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
        
                                </div>

                            </div>
                       
                        </div>


                       
                            
                    </div>                                                
                </div>





    
    </div>

    <script>
        $(document).ready(function() {
            $('#selected_user').change(function() {
                if ($(this).val() === 'all_user_panel') {
                    $('select[name="condition_one"], select[name="condition_two"]').prop('disabled', false);
                    $('input[name="specific_user_data"]').prop('disabled', true);
                }else if($(this).val() === 'specific_user_panel'){
                    $('input[name="specific_user_data"]').prop('disabled', false);
                    $('select[name="condition_one"], select[name="condition_two"]').prop('disabled', true);
                } else {
                    $('select[name="condition_one"], select[name="condition_two"]').prop('disabled', true);
                    $('input[name="specific_user_data"]').prop('disabled', true);
                }
            });
        });

        $(document).ready(function() {
            $('.dropify').dropify();
        });

        
    </script>


              
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
