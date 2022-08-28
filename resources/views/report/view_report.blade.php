@section('title') 
Report
@endsection 
@extends('layouts.report')
@section('style')

@endsection 
@section('rightbar-content')
<!-- Start Breadcrumbbar -->                    
<div class="breadcrumbbar">
    <div class="row align-items-center">
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
                                    </tr>
                                </thead>
                                @if(count($PendingOrders) > 0)
                                    @foreach ($PendingOrders as  $i=>$order_data)
                                    <tr style="border:solid 1px">
                                        <td>{{$i+1}}</td>
                                        <td>
                                            {{$order_data['Order']->customer_name}}
                                        </td>
                                        <td>
                                            {{$order_data['Order']->order_number}}
                                        </td>
                                        <td>{{$order_data['Order']->order_total_price}}</td>
                                        <td>
                                            {{$order_data['Order']->TotalItems}}
                                        </td>
                                        <td>
                                            {{$order_data['Order']->name}}
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td colspan="6" style="border:solid 2px">
                                            <table class="table table-borderless">                                        
                                                <tbody>
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Item</th>
                                                            <th>quantity</th>
                                                            <th>Item Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($order_data['OrderDetail'] as $ii=>$order_item_data)
                                                        <tr>
                                                            <td></td>
                                                            <td>{{ $order_item_data->productName }}</td>
                                                            <td>{{ $order_item_data->productQuantity }}</td>
                                                            <td>{{ $order_item_data->productPrice }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                        </td>     
                                    </tr>
                                    @endforeach
                                @else
                                <tr><td colspan="6"><center>No Data Found</center></td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
    </div>          
</div>
<!-- End Breadcrumbbar -->
<!-- Start Contentbar -->    

<!-- End Contentbar -->
@endsection 
@section('script')
<!-- Form Step js -->
<script src="{{ asset('assets/plugins/jquery-step/jquery.steps.min.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-form-wizard.js') }}"></script>
<script>

    $(document).on("click","#generateReport",function(){
        window.open("viewReport", "myWindow", "width=600,height=800");
    })
</script>
@endsection 