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
                    <li class="breadcrumb-item"><a href="#">Users</a></li>
                </ol>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="widgetbar">
                @can('user-create')
                <button type="button" class="btn btn-primary-rgba" id="add_record_btn">
                    <i class="feather icon-plus mr-2"></i>Add User
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
                    <h5 class="card-title">Users</h5>
                </div>
                <div class="card-body">
                    <h6 class="card-subtitle">Export data to Copy, CSV, Excel & Note.</h6>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                
                                    @foreach ($users as  $user_data)
                                        <tr>
                                            <td>{{$user_data['name']}}</td>
                                            <td>{{$user_data['email']}}</td>
                                            
                                            <td>
                                                @can('user-view')
                                                <a href="#" data-action="view" data-id="{{$user_data['id']}}" class="row-btn text-primary mr-2">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                @endcan
                                                @can('user-edit')
                                                <a href="#" data-action="edit" data-id="{{$user_data['id']}}" class="row-btn text-primary mr-2">
                                                    <i class="feather icon-edit-2"></i>
                                                </a>
                                                @endcan
                                                @can('user-delete')
                                                <a href="#" data-action="delete" data-id="{{$user_data['id']}}" class="row-btn text-primary mr-2">
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
            
            <form method="POST" action="add_user" id="form">
            @csrf
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="name">User Name</label>
                        <input type="text" class="form-control user_input" placeholder="User Name" id="name" name="name">
                        <input type="hidden" class="form-control" id="id" name="id">
                    </div>                                                    
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="email">User Email</label>
                        <input type="text" class="form-control user_input" placeholder="Email" id="email" name="email">
                    </div>                                                    
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="password">User Password</label>
                        <input type="password" class="form-control user_input" placeholder="********" id="password" name="password">
                    </div>                                                    
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="password">Role</label>

                        {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
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
var component = "user";
$(document).ready(function () {
    $('#form').validate({ // initialize the plugin
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email:true
                
            },
            password: {
                required: true,
            }
        }
    });
     $(document).on("click",".row-btn",function(){
        var form_action = "edit_user";
        var visibility = $(this).data("action");
        var id = $(this).data("id");
        
        get_record_detail(component,id,visibility);
        OpenModal(form_action);
    });
    $(document).on("click","#add_record_btn",function(){
        var form_action = "add_user";
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