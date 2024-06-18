@extends('layouts.main') 
@section('title', 'Profile')
@section('content')
    

    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-file-text bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('User Profile')}}</h5>
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route('dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Pages')}}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('User Profile')}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="card">
               
                    <div class="card-body">
                        <div class="text-center"> 
                            
                            <img src="{{ __($users->images)}}" class="rounded-circle" width="150" height="150"/>
                            <h4 class="card-title mt-10">{{ __($users->name)}}</h4>
                            <p class="card-subtitle">{{ __($users->profileTag)}}</p>
                            <h4 class="card-title mt-10">{{ __('Age')}} {{ __(\Carbon\Carbon::parse($users->dob)->age )}}</h4>
                            <div class="row text-center justify-content-md-center">
                                <div class="col-4"><a href="javascript:void(0)" class="link"><i class="ik ik-cycle"></i> <font class="font-medium">{{ __('period')}} {{ __($users->period)}}</font></a></div>
                                <div class="col-4"><a href="javascript:void(0)" class="link"><i class="ik ik-cycle"></i> <font class="font-medium">{{ __('cycle')}} {{ __($users->cycle)}}</font></a></div>
                            </div>
                      
                        </div>
                    </div>
                    <hr class="mb-0"> 
                    <div class="card-body"> 
                        <small class="text-muted d-block pt-10">{{ __('Age')}}</small>
                        <h6>{{ __(\Carbon\Carbon::parse($users->dob)->age)}}</h6> 
                        <small class="text-muted d-block pt-10">{{ __('Period')}}</small>
                        <h6>{{ __($users->period)}}</h6> 
                        <small class="text-muted d-block pt-10">{{ __('Cycle')}}</small>
                        <h6>{{ __($users->cycle)}}</h6> 
                       
                        <small class="text-muted d-block pt-10">{{ __('Phone')}}</small>
                        <h6>{{ __($users->phone)}}</h6> 
                  
                        <small class="text-muted d-block">{{ __('Email address')}} </small>
                        <h6>{{ __($users->email)}}</h6> 
                        <small class="text-muted d-block pt-10">{{ __('Device')}}</small>
                        <h6>{{ __($users->platform)}}</h6> 

                        <small class="text-muted d-block pt-10">{{ __('Gender')}}</small>
                        <h6>{{ __($users->gender)}}</h6> 

                        <small class="text-muted d-block pt-10">{{ __('User Type')}}</small>
                        <h6>{{ __($users->profileTag)}}</h6> 
                        <small class="text-muted d-block pt-10">{{ __('Address')}}</small>
                        <h6>{{ __($users->address)}}</h6> 
        
    
                    </div>
             
                </div>
            </div>

            {{-- {
                "id": 112,
                "name": "Sayma ",
                "username": "sayma",
                "phone": "8801764768110",
                "email": "saymanasrin9@gmail.com",
                "password": "$2b$10$yMGXT8gUiYf5zSCEHwHP1eHUtKPUws2rrxrl5WCZhUcyNIrcGeYlS",
                "images": "https://chondo.s3.ap-southeast-1.amazonaws.com/users/ac3cc576-15fa-4545-9017-7f3ecfffa15a96bbb084-0906-4de3-b8f9-af23f97c1e5a5691601868164973780.jpg_compressed.jpg",
                "photoId": "https://chondo.s3.ap-southeast-1.amazonaws.com/photoid/4074252b-4f1f-46bc-8a0e-469f98c4eb66663069a7-8132-4a9b-a21a-70d410679cf72014873526113704835.jpg_compressed.jpg",
                "isVerified": true,
                "otp": null,
                "gender": "Female",
                "salt": "$2b$10$yMGXT8gUiYf5zSCEHwHP1e",
                "dob": "1995-08-02",
                "cycle": 28,
                "period": 7,
                "platform": "android",
                "address": null,
                "city": null,
                "region": null,
                "country": null,
                "fcmToken": "esbQGoflRoWt53HWR5M9SD:APA91bG0TgIvbC6Bm-fRG2Qxi611JurEk32AitnbbynTJ6ZpnnDpBFkWZ0VjcandQqwvyOn1BCyOPnRAhD0d1n7NalUUcrimsCaiao2_xnf3Cm0yjYWRCNAp-I-Fun6_I8krNJTjUI2o",
                "profileTag": "New User",
                "isActive": true,
                "createdAt": "2023-08-12T18:30:19.908Z",
                "updatedAt": "2023-08-12T18:30:19.908Z"
              } --}}
        

            <div class="col-lg-8 col-md-7">
                <div class="card">
                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link active" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">{{ __('Verify User')}}</a>
                        </li>
             
  

                    </ul>
                    <div class="tab-content" id="pills-tabContent">

            
                        <div class="tab-pane fade show active"  id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <form class="form-horizontal" action="{{ route('dataverify',['id' => $users->id]) }}" data-toggle="validator" method="GET" enctype="multipart/form-data" >
                                   

                                    <div class="form-group">
                                        <label for="example-email">{{ __('Selfie ')}}</label>
                                        <img src="{{ __($users->images)}}" class="rounded-circle" width="250" height="250"/>
                                

                                      <br>
                                      <br>
                                        <label for="example-email">{{ __('Photo ID')}}</label>
                                        <img src="{{ __($users->photoId)}}" class="circle" width="250" />
                                    </div>
    
                                    <div class="form-group">
                                        <label for="example-country">{{ __('Select Status')}}</label>
                                        <select name="message"  class="form-control">
                                            <option>{{ __('Verified')}}</option>
                                            <option>{{ __('Unverified')}}</option>
                                 
                                        </select>
                                    </div>
                                    <button class="btn btn-success" type="submit">Verify User</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
