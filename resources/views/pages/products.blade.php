@extends('layouts.main')
@section('title', 'Products')
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
                    <div class="card-header">
                       
                        <a href="{{ route('product.create') }}" class="btn btn-primary"><i class="ik ik-plus-circle"></i> {{ __('Add New') }}</a>
                    
                    </div>
                   
                    <div class="card-body">
                        <table id="data_table" class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('Id')}}</th>
                                    <th class="nosort">{{ __('Thumbnail')}}</th>
                                    <th>{{ __('Name')}}</th>
                                    <th>{{ __('Category')}}</th>
                                    <th>{{ __('Price')}}</th>
                                    <th class="nosort">{{ __('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="{{ $product->image }}" class="table-user-thumb" alt=""></td>
                                    <td>{{ $product->name}}</td>
                                    <td>{{ $product->category_name}}</td>
                                    <td>{{ $product->price}}</td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="{{ route('product.view', $product->id) }}"><i class="ik ik-eye"></i></a>
                                            <a href="{{ route('product.edit', $product->id) }}"><i class="ik ik-edit-2"></i></a>
                                           
                                                <button onclick="deleteData({{ $product->id }})" style="background: none; border: none; padding: 0; margin: 0;">
                                                    <i class="ik ik-trash-2"  ></i>
                                                </button>
                                        
                                                                                    </div>
                                    </td>
                                </tr>
                                @endforeach
                               
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        async function deleteData(id) {
            
       
       Swal.fire({
           title: "Are you sure?",
           text: "You won't be able to revert this!",
           icon: "warning",
           showCancelButton: true,
           confirmButtonColor: "#3085d6",
           cancelButtonColor: "#d33",
           confirmButtonText: "Yes, delete it!"
       }).then((result) => {
           if (result.isConfirmed) {
               axios.delete('/products/delete/' + id)
                   .then(function(response) {
                       window.location.reload();
                   })
               Swal.fire({
                   title: "Deleted!",
                   text: "Your file has been deleted.",
                   icon: "success"
               });
           }
       });
       
       
       }
</script>
       

    <!-- push external js -->
    @push('script')
        <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('js/datatables.js') }}"></script>
    @endpush
    @if (session()->has('success'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            iconColor: 'yellow',
            customClass: {
                popup: 'colored-toast',
            },
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
        })

        ;
        (async () => {
            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}',
            })
        })()
    </script>
@endif

@if (session()->has('warning'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            iconColor: 'white',
            customClass: {
                popup: 'colored-toast',
            },
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
        })

        ;
        (async () => {
            Toast.fire({
                icon: 'warning',
                title: '{{ session('warning') }}',
            })
        })()
    </script>
@endif

@endsection
