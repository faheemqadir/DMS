@section('title') 
Soyuz - Form Wizards
@endsection 
@extends('layouts.main')
@section('style')

@endsection 
@section('rightbar-content')
<!-- Start Breadcrumbbar -->                    
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Wizards</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Settings</a></li>
                </ol>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="widgetbar">
                <button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Actions</button>
            </div>                        
        </div>
    </div>          
</div>
<!-- End Breadcrumbbar -->
<!-- Start Contentbar -->    
<div class="contentbar">
    <!-- Start row -->
    <div class="row">
    <div class="offset-3 col-lg-6">
        <div class="card m-b-30">
            <div class="card-header">
                <h5 class="card-title">Settings</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="save_setting" id="setting_form">
                @csrf
                <div class="form-group row">
                    <label class="col-lg-3" for="">Credit Limit</label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="credit_limit" value="{{$settings[0]['setting_value']}}" id="credit_limit">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3" for="">Order Start Time</label>
                    <div class="col-lg-9">
                        <input type="time" class="form-control" name="order_start_time" value="{{$settings[1]['setting_value']}}" id="order_start_time">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3" for="">Order End Time</label>
                    <div class="col-lg-9">
                        <input type="time" class="form-control" name="order_end_time" value="{{$settings[2]['setting_value']}}" id="order_end_time">
                    </div>
                </div>
                
                
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="feather icon-plus mr-2"></i>SAVE
                </button>
                </div>
                <form> 
            </div>
        </div>
    </div>
    </div> 
    <!-- End row -->
</div>
<!-- End Contentbar -->
@endsection 
@section('script')
<!-- Form Step js -->
<script src="{{ asset('assets/plugins/jquery-step/jquery.steps.min.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-form-wizard.js') }}"></script>
@endsection 