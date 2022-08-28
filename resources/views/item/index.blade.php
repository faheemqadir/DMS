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
                    <li class="breadcrumb-item"><a href="#">Items</a></li>
                </ol>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="widgetbar">
                @can('items-create')
                    <button type="button" class="btn btn-primary-rgba" id="add_record_btn">
                        <i class="feather icon-plus mr-2"></i>Add Item
                    </button>
                @endcan
                @can('items-update')
                <button type="button" class="btn btn-primary-rgba" id="update_all_items">
                    <i class="feather icon-edit mr-2"></i>Update Item
                </button>
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
                <div class="card-header">
                    <h5 class="card-title">Items</h5>
                </div>
                <div class="card-body">
                    <h6 class="card-subtitle">Export data to Copy, CSV, Excel & Note.</h6>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Item Desription</th>
                                <th>Item Weight Type</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                
                                    @foreach ($items as  $item_data)
                                        <tr>
                                            <td>{{$item_data['productName']}}</td>
                                            <td>{{$item_data['productDescription']}}</td>
                                            <td>{{$item_data['productScale']}}</td>
                                            <td>
                                                @can('items-view')
                                                <a href="#" data-action="view" data-id="{{$item_data['productId']}}" class="row-btn text-primary mr-2">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                @endcan
                                                @can('items-edit')
                                                <a href="#" data-action="edit" data-id="{{$item_data['productId']}}" class="row-btn text-primary mr-2">
                                                    <i class="feather icon-edit-2"></i>
                                                </a>
                                                @endcan
                                                @can('items-delete')
                                                <a href="#" data-action="delete" data-id="{{$item_data['productId']}}" class="row-btn text-primary mr-2">
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
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRecord">Add New Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form method="POST" action="add_item" id="form">
            @csrf
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="productName">Item Name</label>
                        <input type="text" class="form-control user_input" placeholder="Item Name" id="productName" name="productName">
                        <input type="hidden" class="form-control" id="productId" name="productId">
                    </div>                                                    
                </div>
                <div class="form-row hdn-fields d-none">
                    <div class="form-group col-md-12">
                        <label for="productName">Item Sale Price</label>
                        <input type="text" class="form-control" id="item_sale_price" disabled>
                    </div>                                                    
                </div>
                <div class="form-row hdn-fields d-none">
                    <div class="form-group col-md-12">
                        <label for="productName">Item Quantity</label>
                        <input type="text" class="form-control" id="item_qty" disabled>
                    </div>                                                    
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="productDescription">Item Description</label>
                        <input type="text" class="form-control user_input" placeholder="Item Description" id="productDescription" name="productDescription">
                    </div>                                                    
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="productScale">Item Weigth Type</label>
                        <!--
                        <input type="text" class="form-control" placeholder="Add Item Weigth Type" id="productScale" name="productScale">
                        -->
                        <select class="form-control user_input" id = "productScale" name = "productScale">
                                <option value="1" > KG </option>
                                <option value="2" > Litter </option>
                                <option value="3" > Dozzen </option>
                        <select>
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
<div class="modal fade text-left" id="update_item_form_modal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRecord"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form method="POST" action="update_all_item" id="form">
            @csrf
            <div class="modal-body">

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="productName">Item Name</label>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="productName">Sale Price</label>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="productName">Item Quantity</label>
                    </div>
                </div>
                @foreach ($items as  $item_data)
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            {{$item_data['productName']}}
                        </div>
                        
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control item_input" placeholder="Sale price" value="{{$item_data['productRetailRaterice']}}" id="productRetailRaterice" name="productRetailRaterice[]" required="required">
                            <input type="hidden" class="form-control" name="productId[]" id="productId" value="{{$item_data['productId']}}">
                        </div>  
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control item_input" placeholder="Sale price" value="{{$item_data['productQuantity']}}" id="productQuantity" name="productQuantity[]" required="required">
                        </div>                                                    
                    </div>
                    
                @endforeach
                
                
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
var component = "item";
$(document).ready(function () {
    $('#form').validate({ // initialize the plugin
        rules: {
            productName: {
                required: true
            },
            productScale: {
                required: true,
            }
        }
    });
    $('#update_item_form_modal').validate({ // initialize the plugin
        submitHandler: function(form) {
            form.submit();
        }
    });


    

     $(document).on("click",".row-btn",function(){
        var form_action = "edit_item";
        var visibility = $(this).data("action");
        var id = $(this).data("id");
        
        $(".hdn-fields").removeClass("d-none")
        get_record_detail(component,id,visibility);
        OpenModal(form_action);
    });
    $(document).on("click","#add_record_btn",function(){
        var form_action = "add_item";
        $("#addRecord").html("Add New Record")
        $(".hdn-fields").addClass("d-none")
        OpenModal(form_action);
    });
    $(document).on("click","#update_all_items",function(){
        var form_action = "update_all_item";
        var modal_id = "update_item_form_modal"
        $("#addRecord").html("Update Items")

        OpenModal(form_action,modal_id);
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
                $('#productId').val(id)
                $('#productName').val(data[0].productName)
                $('#productDescription').val(data[0].productDescription)
                $('#productScale').val(data[0].productScale)

                //$('#item_purchase_price').val(data[0].item_purchase_price)
                $('#item_sale_price').val(data[0].productRetailRaterice)
                $('#item_qty').val(data[0].productQuantity)
                
            }
        });
    }
}
</script>
@endsection 