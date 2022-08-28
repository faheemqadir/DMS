@section('title') 
Soyuz - Datatable
@endsection 
@extends('layouts.main')
@section('style')
<!-- DataTables css -->
<link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive Datatable css -->
<link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('rightbar-content')
<!-- Start Breadcrumbbar -->                    
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Roles</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/roles')}}">Roles</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Role Details</li>
                </ol>
            </div>
        </div>
        
    </div>          
</div>
<!-- End Breadcrumbbar -->
<!-- Start Contentbar -->    
<div class="contentbar">                
    <!-- Start row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30"> 
                <div class="card-header">
                    <h5 class="card-title">Role Detail</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <label class="col-lg-3">Name:</label>
                        <div class="col-lg-9">
                            {{ $role->name }}
                        </div>
                        <label class="col-lg-3 mt-2">Permission</label>
                        <div class="col-lg-9 mt-2">
                            <div class="row">
                                <div class="col-lg-10">
                                @if(!empty($rolePermissions))
                                    @foreach($rolePermissions as $v)
                                        <label class="btn btn-success btn-xs">{{ $v->name }}</label>
                                    @endforeach
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>
@endsection