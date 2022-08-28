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
            <h4 class="page-title">Customers</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{url('/customer')}}">Customers</a></li>
                    <li class="breadcrumb-item"><a href="#">Customer Wallet</a></li>
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
        <!-- Start col -->
        <div class="col-lg-12">
            <div class="card m-b-30">
                <!-- <div class="card-header">
                    <h5 class="card-title">Customers</h5>
                </div> -->
                <div class="card-body">
                    <div class="offset-3 col-lg-6">
                    <form method="POST" action="update_customer_wallet" id="form_wallet">
                        @csrf
                        <div class="row">
                            <label class="col-sm-5">Select Customer</label>
                            <div class="col-sm-7">
                                <!-- <input type="text" class="form-control" id="wallet_amount" readonly> -->
                                <select  id="customer" name="customer" class="form-control">
                                    <option value="">Select Customer</option>
                                @foreach ($customers as  $customer_data)
                                    <option value="{{$customer_data['id']}}">{{$customer_data['customer_name']}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <label class="col-sm-5">Transcation Amount</label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control" id="transcation_amount" name="transcation_amount">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <label class="col-sm-5">Transcation Type</label>
                            <div class="col-sm-7">
                                <select class="form-control" id="transcation_type" name="transcation_type">
                                    <option value="">select option</option>
                                    <option value="1">Cash</option>
                                    <option value="2">Easy Paisa</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <label class="col-sm-5">Transcation Number</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="transcation_number" name="transcation_number">
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary"><i class="feather icon-plus mr-2"></i>SAVE</button>
                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End col -->
    </div>
    <!-- End row -->
</div>

<!-- End Contentbar -->
@endsection 
@section('script')
<!-- Datatable js -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-table-datatable.js') }}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="{{ asset('assets/js/scripts/custom.js') }}"></script>
    
<script>
var component = "customer";
$(document).ready(function () {
    $('#form_wallet').validate({ // initialize the plugin
        rules: {
            customer: {
                required: true
            },
            transcation_amount: {
                required: true
            },
            transcation_type: {
                required: true,
            },
            transcation_number:{
                required: true,
            }
        
        }
    });


 
});


</script>
@endsection 