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
            <h4 class="page-title">Datatable</h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Orders</a></li>
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
                <div class="card-header">
                    <h5 class="card-title">Orders</h5>
                </div>
                <div class="card-body">
                    <h6 class="card-subtitle">Export data to Copy, CSV, Excel & Note.</h6>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Shop</th>
                                <th>Customer</th>
                                <th>Rider</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Total Purchase Amount</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                    @foreach ($orders as  $order_data)
                                        <tr>
                                            <td>{{$order_data->id}}</td>
                                            <td>{{$order_data->shop_name}}</td>
                                            <td>{{$order_data->customer_name}}</td>
                                            <td>{{$order_data->name}}</td>
                                            <td>{{$order_data->order_status}}</td>
                                            <td>{{$order_data->order_date}}</td>
                                            <td>{{$order_data->order_total_price}}</td>
                                            <td>
                                                @can('order-view')
                                                <a href="{{url('/order_detail_items/'.$order_data->id)}}"   class="text-primary mr-2">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                @endcan
                                                <!-- <a href="#" data-action="edit" data-id="{{$order_data->id}}" class="text-primary mr-2">
                                                    <i class="feather icon-edit-2"></i>
                                                </a>
                                                <a href="#" data-action="delete" data-id="{{$order_data->id}}" class="text-primary mr-2">
                                                    <i class="fa fa-trash"></i>
                                                </a> -->
                                            </td>
                                        </tr>    
                                    @endforeach
                               
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End col -->
    </div>
    <!-- End row -->
</div>
<div class="modal fade text-left" id="form_modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRecord">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" action="add_user" id="form">
            @csrf
            <div class="modal-body">
                <table class="table">

                    <tr>
                        <th>Customer Name</th>
                        <th colspan="2">Customer Contact</th>
                    </tr>
                    <tr>
                        <td id="customer_name"></td>
                        <td colspan="2" id="cust_contact"></td>
                    </tr>
                    <tr>
                        <th>Order Number</th>
                        <th>Order Date</th>
                        <th>Order Price</th>
                    </tr>
                    <tr>
                        <td id="order_number"></td>
                        <td id="order_date"></td>
                        <td id="order_price"></td>
                    </tr>
                    <tr>
                        <th>Rider</th>
                        <td colspan="2" id="rider"></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <table class="table" id="item_history">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Milk</th>
                                        <th>12</th>
                                        <th>12000</th>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="feather icon-plus mr-2"></i>SAVE
                </button>
            </div>
            </form>
        </div>
    </div>
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
var component = "order";
$(document).ready(function () {

     $(document).on("click","#view_order",function(){
        var OrderId=$(this).data("id")
        
        var form_action = "order_detail_items";
        component="order_detail_items";
        get_record_detail(component,OrderId);
        OpenModal(form_action);
    });
    
});
function get_record_detail(component,id){
    if(id){
        
        get_record_details_ajax(component,id).done(function(response){
            if( response.status == 1 ){
                var data = response.data;
                //status
                console.log(data)
                // customer_name
                // cust_contact
                // order_number
                // order_date
                // order_price
                // rider
                // item_history
                $('#id').val(id)
                $('#name').val(data[0].name)
                $('#email').val(data[0].email)
                $('#password').val(data[0].password)
               
            }
        });
    }
}
</script>
@endsection 