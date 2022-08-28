@section('title') 
Soyuz - Home
@endsection 
@extends('layouts.main')
@section('style')
<!-- Apex css -->
<link href="{{ asset('assets/plugins/apexcharts/apexcharts.css') }}" rel="stylesheet" type="text/css" />
<!-- jvectormap css -->
<link href="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" type="text/css" />
<!-- Slick css -->
<link href="{{ asset('assets/plugins/slick/slick.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/slick/slick-theme.css') }}" rel="stylesheet" type="text/css" />
@endsection 
@section('rightbar-content')

<!-- Start Breadcrumbbar -->                    
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title">Dashboard</h4>
            <!-- <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">CRM</li>
                </ol>
            </div> -->
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
        <!-- Start col -->
        <div class="col-lg-12 col-xl-8">
            <!-- Start row -->
            <div class="row">
                <!-- Start col -->
                <div class="col-lg-12 col-xl-3">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-5">
                                    <h4 id="total_orders">0</h4>
                                </div>
                                <div class="col-7 text-right">
                                    <p class="font-14 mb-0">Total Orders</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Start col -->
                <div class="col-lg-12 col-xl-3">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-5">
                                    <h4 id="new_orders">0</h4>
                                </div>
                                <div class="col-7 text-right">
                                    <p class="font-14 mb-0">New Orders</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End col -->
                <!-- Start col -->
                <div class="col-lg-12 col-xl-3">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-5">
                                    <h4 id="pending_orders">0</h4>
                                </div>
                                <div class="col-7">
                                     <p class="font-14 mb-0">Pending orders</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End col -->
                <!-- Start col -->
                <div class="col-lg-12 col-xl-3">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-5">
                                    <h4 id="processed_orders">0</h4>
                                </div>
                                <div class="col-7">
                                    <p class="font-14 mb-0">Processed Orders</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End col -->
                <!-- Start col -->
                <div class="col-lg-12 col-xl-12">
                    <div class="card m-b-30">
                        <div class="card-header">                                
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <h5 class="card-title mb-0">New Orders</h5>
                                </div>
                                <div class="col-3">
                                    <div class="dropdown">
                                        <button class="btn btn-link p-0 font-18 float-right" type="button" id="upcomingTask" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal-"></i></button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="upcomingTask">
                                            <a class="dropdown-item font-13" href="#">Refresh</a>
                                            <a class="dropdown-item font-13" href="#">Export</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless" id="new_orders_list">                                        
                                    <thead>
                                        <tr>
                                            <th>S:NO</th>
                                            <th>Customer Name</th>
                                            <th>Order Number</th>
                                            <th>Order Price</th>
                                            <th>Order Items</th>
                                            <th>Details</th>
                                            <th>Approve</th>
                                        </tr>
                                    </thead>
                                    <tbody >
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
        <!-- End col -->
        <!-- Start col -->
        <div class="col-lg-12 col-xl-4">
            <div class="card m-b-30">
                <div class="card-header">                                
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h5 class="card-title mb-0">Items Status</h5>
                        </div>
                        
                    </div>
                </div>
                <div class="card-body crm-tab-widget">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="nav flex-column nav-pills" id="v-pills-ticket-tab" role="tablist" aria-orientation="vertical">
                                <table class="table" id="items_count_detail">
                                    <thead>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Ordered</th>
                                        <th>Remaining</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>        
                                  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-3 d-none">
            <div class="card m-b-30">
                <div class="card-header">                                
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h5 class="card-title mb-0">Top Performer</h5>
                        </div>
                        <div class="col-3">
                            <div class="dropdown">
                                <button class="btn btn-link p-0 font-18 float-right" type="button" id="widgetRevenue" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal-"></i></button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="widgetRevenue">
                                    <a class="dropdown-item font-13" href="#">Refresh</a>
                                    <a class="dropdown-item font-13" href="#">Export</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                            
                <div class="user-slider">
                    @foreach ($Users as  $users_data)
                    <div class="user-slider-item">
                        <div class="card-body text-center">
                            <h5>{{$users_data['name']}}</h5>
                            <div class="button-list mt-4">
                                <button type="button" class="btn btn-round btn-secondary-rgba"><i class="feather icon-phone"></i></button>
                                <button type="button" class="btn btn-round btn-secondary-rgba"><i class="feather icon-mail"></i></button>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <div class="row">
                                <div class="col-6 border-right">
                                    <h4>253</h4>
                                    <p class="my-2">Task Done</p>
                                </div>
                                <div class="col-6">
                                    <h4>51</h4>
                                    <p class="my-2">New Leads</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach                           
                </div>                            
            </div>      
        </div>
        <div class="col-lg-12 col-xl-12">
            <div class="card m-b-30">
                <div class="card-header">                                
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h5 class="card-title mb-0">Pending Orders</h5>
                        </div>
                        <div class="col-3">
                            <div class="dropdown">
                                <button class="btn btn-link p-0 font-18 float-right" type="button" id="upcomingTask" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal-"></i></button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="upcomingTask">
                                    <a class="dropdown-item font-13" href="#">Refresh</a>
                                    <a class="dropdown-item font-13" href="#">Export</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">                                        
                            <tbody>
                                <thead>
                                    <tr>
                                        <th>S:NO</th>
                                        <th>Customer Name</th>
                                        <th>Order Number</th>
                                        <th>Order Price</th>
                                        <th>Order Items</th>
                                        <th>Rider</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                @foreach ($PendingOrders as  $i=>$order_data)
                                <tr>
                                    <td>{{$i+1}}</td>
                                    <td>
                                        {{$order_data->customer_name}}
                                    </td>
                                    <td>
                                        {{$order_data->order_number}}
                                    </td>
                                    <td>{{$order_data->order_total_price}}</td>
                                    <td>
                                        {{$order_data->TotalItems}}
                                    </td>
                                    <td>
                                        {{$order_data->name}}
                                    </td>
                                    <td>
                                        <a href="#" class="text-primary mr-2 order-details" data-id="{{$order_data->id}}" >
                                            <i class="feather icon-list"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach                       
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-12">
                    <div class="card m-b-30">
                        <div class="card-header">                                
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <h5 class="card-title mb-0">Processd Orders</h5>
                                </div>
                                <div class="col-3">
                                    <div class="dropdown">
                                        <button class="btn btn-link p-0 font-18 float-right" type="button" id="upcomingTask" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal-"></i></button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="upcomingTask">
                                            <a class="dropdown-item font-13" href="#">Refresh</a>
                                            <a class="dropdown-item font-13" href="#">Export</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless">                                        
                                    <tbody>
                                        <thead>
                                            <tr>
                                                <th>S:NO</th>
                                                <th>Customer Name</th>
                                                <th>Order Number</th>
                                                <th>Order Price</th>
                                                <th>Order Items</th>
                                                <th>Rider</th>
                                                <th>Details</th>
                                            </tr>
                                        </thead>
                                        @foreach ($ProcessedOrders as  $i=>$order_data)
                                        <tr>
                                            <td>{{$i+1}}</td>
                                            <td>
                                                {{$order_data->customer_name}}
                                            </td>
                                            <td>
                                                {{$order_data->order_number}}
                                            </td>
                                            <td>{{$order_data->order_total_price}}</td>
                                            <td>
                                                {{$order_data->TotalItems}}
                                            </td>
                                             <td>
                                                {{$order_data->name}}
                                            </td>
                                            <td>
                                                <a href="#" class="text-primary mr-2 order-details" data-id="{{$order_data->id}}" >
                                                    <i class="feather icon-list"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" class="text-primary mr-2 order-row" data-id="{{$order_data->id}}" >
                                                    <i class="feather icon-edit-2"></i>
                                                </a>
                                                
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
<div class="modal fade  show" id="my_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleSmallModalLabel">Approve Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" id="resp_msg" style="text-align: center;"></div>
                    <div class="form-group col-md-12">
                        <label for="customer_name">Customer Name</label>
                        <select class="form-control" id="user_list">
                            <option value="">select rider</option>
                            @foreach ($Users as  $i=>$user_data)
                                <option value="{{$user_data['id']}}">{{$user_data['name']}}</option>
                            @endforeach   
                        </select>
                    </div>
                          
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="assign_rider">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="order_detail_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleSmallModalLabel">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label class="col-sm-3">Order Number</label>
                    <div class="col-sm-9" id="order_num"></div>
                    <label class="col-sm-3">Customer name</label>
                    <div class="col-sm-9" id="customer_name"></div>
                    <table class="table" id="order_detail_table">
                        <thead>
                            <th>SNO</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <th>Total</th>
                                <th id="order_total"></th>
                            </tr>
                        </tfoot>
                    </table>      
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade  show" id="ticker_modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleSmallModalLabel">Order Recipt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" id="resp_msg" style="text-align: center;"></div>
                    <div class="col-md-12"  style="border:solid 1px">
                    <label for="">Customer Name :</label><span>abc</span><br>
                    <label for="">Order Number  :</label><span>12121212</span><br>
                    <label for="">Order Price   :</label><span>34444</span><br>
                    <label for="">Order Item    :</label><span>45</span><br>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- End Contentbar -->
@endsection 
@section('script')
<!-- Apex js -->
<script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/plugins/apexcharts/irregular-data-series.js') }}"></script>
<!-- jVector Maps js -->
<script src="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- Slick js -->
<script src="{{ asset('assets/plugins/slick/slick.min.js') }}"></script>
<!-- Custom Dashboard js -->  
<script src="{{ asset('assets/js/custom/custom-dashboard.js') }}"></script>
<script>
    $(document).ready(function () {
        $(document).on("click",".order-details",function(){
            var id = $(this).data("id");

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                'url': 'order_details',
                'type': 'POST',
                'dataType': 'json',
                'data':{order_id:id},
            }).done(function (response) {
                //order_detail_table

                if(response.status == 1){
                    var data = response.data;
                    var tableData="";
                    var order_num="";
                    var customer_name="";
                    var total_amount=0;
                    //$("#order_num").html(order_number);
                    $.each(data,function(e,obj){

                        if(e == 0) order_num = obj.order_number;customer_name =obj.customer_name; 

                        total_amount+=parseInt(obj.productPrice);
                        tableData +="<tr>";
                        tableData +="<td>"+(e+1)+"</td>";
                        tableData +="<td>"+obj.ProductName+"</td>";
                        tableData +="<td>"+obj.productQuantity+"</td>";
                        tableData +="<td>"+obj.productPrice+"</td>";
                        tableData +="</tr>";
                    })
                    $("#order_num").html(order_num)
                    $("#customer_name").html(customer_name)
                    $("#order_total").html(total_amount);
                    $("#order_detail_table tbody").html(tableData)
                    $("#order_detail_modal").modal("show")
                }


            }).fail(function(xhr, ajaxOps, error) {

            });
            
        });
        $(document).on("click",".order-row",function(){
            var id = $(this).data("id");

            $("#my_modal").modal('show');
            $("#my_modal").data('order_id',id);
            $("#user_list").val('');

            $('#resp_msg').removeClass('text-danger');
            $('#resp_msg').removeClass('text-success');
            $('#resp_msg').html("")
        });

        
        $(document).on("click",".order-ticker",function(){
            
            $("#ticker_modal").modal("show")
        });
        $(document).on("click","#assign_rider",function(){
            var user_id = $("#user_list").val();
            var order_id = $("#my_modal").data('order_id');
            
            


            if(user_id){
                let data = { user_id:user_id, order_id: order_id};
                
                $('#resp_msg').removeClass('text-danger');
                $('#resp_msg').removeClass('text-success');
                $('#resp_msg').html("")

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    'url': 'assign_rider',
                    'type': 'POST',
                    'dataType': 'json',
                    'data': data,
                }).done(function (response) {

                    if(response.status == 1){
                        $('#resp_msg').removeClass('text-danger');
                        $('#resp_msg').addClass('text-success');
                        $('#resp_msg').html("Order Assigned to rider successfully");

                        setTimeout(function(){ window.location.reload()}, 1000);
                    }else{
                        $('#resp_msg').addClass('text-danger');
                        $('#resp_msg').html("Unable to update data please contact administrator")
                    }
                    
                }).fail(function(xhr, ajaxOps, error) {

                    $('#resp_msg').addClass('text-danger');
                    $('#resp_msg').html("Request failed please contact administrator")
                    //console.log('Failed: ' + error);
                });
            }else{
                $('#resp_msg').addClass('text-danger');
                $('#resp_msg').html("Please Select Rider to approve this order")
            }
        });

        if(typeof(EventSource) !== "undefined") {
            var source = new EventSource("dahboard_data");

            source.onmessage = function(event) {
                var sJsonData = JSON.parse(event.data);

                $("#total_orders").html(sJsonData.TotalOrders)
                $("#new_orders").html(sJsonData.NewOrdersCount)
                $("#pending_orders").html(sJsonData.PendingOrdersCount)
                $("#processed_orders").html(sJsonData.ProcessedOrdersCount)

                var orders="";
                $.each(sJsonData.Orders,function(e,object){
                    //console.log(object)
                    
                    orders +="<tr>";
                    orders +="<td>"+(e+1)+"</td>";
                    orders +="<td>";
                    orders +=object.customer_name;
                    orders +="</td>";
                    orders +="<td>";
                    orders +=object.order_number;
                    orders +="</td>";
                    orders +="<td>"+object.order_total_price+"</td>";
                    orders +="<td>";
                    orders +=object.TotalItems
                    orders +="</td>";
                    orders +="<td>";
                    orders +="<a href='#' class='text-primary mr-2 order-details' data-id='"+object.id+"'>";
                    orders +="<i class='feather icon-list'></i>";
                    orders +="</a>";
                    orders +="</td>";
                    orders +="<td>";
                    orders +="<a href='#' class='text-primary mr-2 order-row' data-id='"+object.id+"'>";
                    orders +="<i class='feather icon-edit-2'></i>";
                    orders +="</a>";

                    orders +="<a href='#' class='text-primary mr-2 order-ticker' data-id='"+object.id+"'>";
                    orders +="<i class='feather icon-credit-card'></i>";
                    orders +="</a>";

                    orders +="</td>";
                    orders +="</tr>";
                })
                $("#new_orders_list tbody").html(orders)

                var items = "";
                $.each(sJsonData.ItemsDetail,function(e,object){
                    //console.log(object)
                    
                    items +="<tr>";
                    items +="<td>";
                    items +=object.productName;
                    items +="</td>";
                    items +="<td>";
                    items +="</td>";
                    items +="<td>"+object.Ordered+"</td>";
                    items +="<td>";
                    items +=object.Remaining
                    items +="</td>";
                    items +="</tr>";
                });
                $("#items_count_detail tbody").html(items)
            };
        } else {
            document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
        }


    });
</script>
@endsection 