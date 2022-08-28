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
                                        <th>Item Name</th>
                                        <th>Sale Price</th>
                                        <th>Item Quantity</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                @if(count($ItemReport) > 0)
                                    @foreach ($ItemReport as  $i=>$order_data)
                                    <tr style="border:solid 1px">
                                        <td>{{$i+1}}</td>
                                        <td>
                                            {{$order_data->productName}}
                                        </td>
                                        <td>
                                            {{$order_data->TotalSale}}
                                        </td>
                                        <td>{{$order_data->Quantity}}</td>
                                        <td>
                                            {{date("Y-m-d",strtotime($order_data->order_date))}}
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