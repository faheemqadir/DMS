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
                    <li class="breadcrumb-item"><a href="#">Customers</a></li>
                </ol>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="widgetbar">
                @can('customer-create')
                    <button type="button" class="btn btn-primary-rgba" id="add_record_btn" >
                        <i class="feather icon-plus mr-2"></i>Add Customer
                    </button>
                    <!-- <button type="button" >
                        <i class="feather icon-plus mr-2"></i>Add Wallet
                    </button> -->
                    <a href="{{url('/wallet')}}"  class="btn btn-primary-rgba wallet-btn">
                        <i class="fa fa-money"></i>
                    </a>
                @endcan
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
                    <h6 class="card-subtitle">Export data to Copy, CSV, Excel & Note.</h6>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as  $customer_data)
                                    <tr >
                                        <td>{{$customer_data['customer_name']}}</td>
                                        <td>{{$customer_data['customer_email']}}</td>
                                        <td>{{$customer_data['customer_contact']}}</td>
                                        <td>
                                            @can('customer-view')
                                            <a href="#" data-action="view" data-id="{{$customer_data['id']}}" class="row-btn text-primary mr-2">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            @endcan
                                            @can('customer-edit')
                                            <a href="#" data-action="edit" data-id="{{$customer_data['id']}}" class="row-btn text-primary mr-2">
                                                <i class="feather icon-edit-2"></i>
                                            </a>
                                            @endcan
                                            
                                            @can('customer-delete')
                                            <a href="#" data-action="delete" data-id="{{$customer_data['id']}}" class="delete-btn text-primary mr-2">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            @endcan
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
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRecord">Add New Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="" id="form">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="customer_name">Customer Name</label>
                            <input type="text" class="form-control user_input" placeholder="Customer Name" id="customer_name" name="customer_name">
                            <input type="hidden" class="form-control" id="customer_id" name="customer_id">
                        </div>                                                    
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="customer_email">Customer Email</label>
                            <input type="text" class="form-control user_input" placeholder="Email" id="customer_email" name="customer_email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="customer_contact">Cutomer Contact</label>
                            <input type="text" class="form-control user_input" placeholder="Contact" id="customer_contact" name="customer_contact">
                        </div>                                                    
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="customer_address">Customer Address</label>
                            <textarea class="form-control user_input" placeholder="Address" id="customer_address" name="customer_address"></textarea>
                        </div>                                                    
                    </div>
                </div>
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
var component = "customer";
$(document).ready(function () {
    $('#form').validate({ // initialize the plugin
        rules: {
            customer_name: {
                required: true
            },
            customer_email: {
                required: true,
                email: true
            },
            customer_contact: {
                required: true,
            },
            customer_address:{
                required: true,
            }
        
        }
    });


    $(document).on("click",".row-btn",function(){
        var form_action = "edit_customer";
        var visibility = $(this).data("action");
        var id = $(this).data("id");

        get_record_detail(component,id,visibility);
        OpenModal(form_action);
    });
    
   
    $(document).on("click","#add_record_btn",function(){
        var form_action = "add_customer";
        $("#addRecord").html("Add New Record")
        OpenModal(form_action);
    });
});

function get_record_detail(component,id,visibility){

    if(id){
        if(visibility == 'view'){
            $("#addRecord").html("View Record") 
            $(".user_input").css('pointer-events', 'none')
               
        }else{
            $("#addRecord").html("Edit Record")
            $(".user_input").css('pointer-events', 'all') 
            
        }
        get_record_details_ajax(component,id).done(function(response){
            if( response.status == 1 ){
                var data = response.data;
                $('#customer_id').val(id)
                $('#customer_name').val(data[0].customer_name)
                $('#customer_email').val(data[0].customer_email)
                $('#customer_contact').val(data[0].customer_contact)
                $('#customer_address').val(data[0].customer_address)   
            }
        });
    }
}

</script>
@endsection 