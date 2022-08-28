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
                    <li class="breadcrumb-item"><a href="#">Forms</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Wizards</li>
                </ol>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="widgetbar">
                <button class="btn btn-primary-rgba" id="generateTag">Download Orders Tags</button>
            </div>                        
        </div>
    </div>          
</div>
<!-- End Breadcrumbbar -->
<!-- Start Contentbar -->    
<div class="contentbar">
    <!-- Start row -->
    <div class="row">
        <!-- End col -->
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active show" id="v-pills-sale-tab" data-toggle="pill" href="#v-pills-sale" role="tab" aria-controls="v-pills-sale" aria-selected="true">Sell Report</a>

                                <a class="nav-link" id="v-pills-items-tab" data-toggle="pill" href="#v-pills-items" role="tab" aria-controls="v-pills-items" aria-selected="false">Items Report</a>
                                
                                <a class="nav-link" id="v-pills-customers-tab" data-toggle="pill" href="#v-pills-customers" role="tab" aria-controls="v-pills-customers" aria-selected="false">Customers</a>

                                <a class="nav-link" id="v-pills-rider-orders-tab" data-toggle="pill" href="#v-pills-rider-orders" role="tab" aria-controls="v-pills-rider-orders" aria-selected="false">Rider Orders</a>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade active show" id="v-pills-sale" role="tabpanel" aria-labelledby="v-pills-sale-tab">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <div class="col-lg-6 m-0" style="border:solid 2px;border-radius:5px">
                                                <div class="card-header">
                                                    <h5 class="card-title">Generate Sale Report</h5>
                                                </div>
                                                <div class="form-inline">
                                                    <label class="col-sm-3">Start Date</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control" name="inputDate"  value="<?php echo date('Y-m-d'); ?>" id="startDate">
                                                    </div>
                                                </div>
                                                <div class="form-inline mt-3">
                                                    <label class="col-sm-3">End Date</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control" name="inputDate" value="<?php echo date('Y-m-d'); ?>" id="endDate">
                                                    </div>
                                                </div>
                                                <div class="offset-4 col-lg-2 mt-2 text-center mt-3">
                                                    <button id="generateReport" report="generateSaleReport" class="btn btn-primary-rgba">Generate</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-items" role="tabpanel" aria-labelledby="v-pills-items-tab">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <div class="col-lg-6 m-0" style="border:solid 2px;border-radius:5px">
                                                <div class="card-header">
                                                    <h5 class="card-title">Generate Items Sale Report</h5>
                                                </div>
                                                <div class="form-inline">
                                                    <label class="col-sm-3">Start Date</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control" name="inputDate"  value="<?php echo date('Y-m-d'); ?>" id="startDate">
                                                    </div>
                                                </div>
                                                <div class="form-inline mt-3">
                                                    <label class="col-sm-3">End Date</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control" name="inputDate" value="<?php echo date('Y-m-d'); ?>" id="endDate">
                                                    </div>
                                                </div>
                                                <div class="offset-4 col-lg-2 mt-2 text-center mt-3">
                                                    <button id="generateReport" report="generateItemReport" class="btn btn-primary-rgba">Generate</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="v-pills-customers" role="tabpanel" aria-labelledby="v-pills-customers-tab">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <div class="col-lg-6 m-0" style="border:solid 2px;border-radius:5px">
                                                <div class="card-header">
                                                    <h5 class="card-title">Generate Customer Report</h5>
                                                </div>
                                                <div class="form-inline">
                                                    <label class="col-sm-3">Start Date</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control" name="inputDate"  value="<?php echo date('Y-m-d'); ?>" id="startDate">
                                                    </div>
                                                </div>
                                                <div class="form-inline mt-3">
                                                    <label class="col-sm-3">End Date</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control" name="inputDate" value="<?php echo date('Y-m-d'); ?>" id="endDate">
                                                    </div>
                                                </div>
                                                <div class="offset-4 col-lg-2 mt-2 text-center mt-3">
                                                    <button id="generateReport" report="generateCustomerReport" class="btn btn-primary-rgba">Generate</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-rider-orders" role="tabpanel" aria-labelledby="v-pills-rider-orders-tab">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <div class="col-lg-6 m-0" style="border:solid 2px;border-radius:5px">
                                                <div class="card-header">
                                                    <h5 class="card-title">Generate Rider Order Report</h5>
                                                </div>
                                                <div class="form-inline">
                                                    <label class="col-sm-3">Start Date</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control" name="inputDate"  value="<?php echo date('Y-m-d'); ?>" id="startDate">
                                                    </div>
                                                </div>
                                                <div class="form-inline mt-3">
                                                    <label class="col-sm-3">End Date</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control" name="inputDate" value="<?php echo date('Y-m-d'); ?>" id="endDate">
                                                    </div>
                                                </div>
                                                <div class="offset-4 col-lg-2 mt-2 text-center mt-3">
                                                    <button id="generateReport" report="generateRiderOrderReport" class="btn btn-primary-rgba">Generate</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
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
<!-- Form Step js -->
<script src="{{ asset('assets/plugins/jquery-step/jquery.steps.min.js') }}"></script>
<script src="{{ asset('assets/js/custom/custom-form-wizard.js') }}"></script>
<script>

   
    $(document).on("click","#generateReport",function(){

        var sReportName = $(this).attr("report")
        alert(sReportName)
        

        // $sdate=$("#startDate").val();
        // $edate=$("#endDate").val();

        // var ReqReport = "";
        // if(sReportName == "generateItemReport"){
        //     ReqReport = "itemReport"
        // }
        // elseif(sReportName == "generateItemReport"){
        //     ReqReport = "viewReport"
        // }elseif(sReportName == "generateRiderOrderReport"){
        //      ReqReport = "generateRiderOrderReport"
        // }   

        // window.open(ReqReport+"/"+$sdate+"/"+$edate, "myWindow", "width=600,height=800");
    })
    $(document).on("click","#generateTag",function(){
        window.open("generate_order_tags", "myWindow", "");
    })

    
</script>
@endsection 