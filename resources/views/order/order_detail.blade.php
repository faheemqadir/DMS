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
                    <li class="breadcrumb-item"><a href="{{url('/order')}}">Orders</a></li>
                    <li class="breadcrumb-item"><a href="#">Order detail</a></li>
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
                    <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Customer Name</th>
                            <th colspan="2">Contact</th>
                        </tr>
                        <tr>
                            <td id="customer_name">{{$Order->customer_name}}</td>
                            <td colspan="2" id="cust_contact">{{$Order->customer_contact}}</td>
                        </tr>
                        <tr>
                            <th>Order Number</th>
                            <th>Order Date</th>
                            <th>Order Price</th>
                        </tr>
                        <tr>
                            <td id="order_number">{{$Order->order_number}}</td>
                            <td id="order_date">{{$Order->order_date}}</td>
                            <td id="order_price">{{$Order->order_total_price}}</td>
                        </tr>
                        <tr>
                            <th>Rider</th>
                            <td colspan="2" id="rider">{{$Order->name}}</td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                
                                <table class="table" id="item_history">
                                    <thead style="border-top:solid 2px">
                                        <tr>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        @php $r=0 @endphp
                                        @foreach($OrderDetail as $values)
                                        @php $r +=$values->productPrice @endphp
                                        <tr>
                                            <th>{{$values->productName}}</th>
                                            <th>{{$values->productQuantity}}</th>
                                            <th>{{$values->productPrice}}</th>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot style="border-top:solid 2px">
                                        <tr>
                                            <th colspan="2" class="text-right">Total</th>
                                            <th >{{$r}}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </td>
                        </tr>
                        </table>
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
var component = "order";

</script>
@endsection 