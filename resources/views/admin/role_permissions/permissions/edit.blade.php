@extends('admin.admin_dashboard')
@section('title')
Permissions
@endsection
@section('admin')
<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
<div class="page-content">
    <div class="row">
        <div class="col-sm-6">
            <h6 class="mb-0 text-uppercase">Permissions</h6>
        </div>
        <div class="col-sm-6">
            @php
                $next = Spatie\Permission\Models\Permission::where('id', '>', $permission->id)->min('id');
                $previous = Spatie\Permission\Models\Permission::where('id', '<', $permission->id)->max('id');
            @endphp
            <div class="row">
                <div class="col-md-10">
                    <div class="btn-group" role="group" style="float: right;">
                        <a href="{{ (isset($previous))?$previous:'javascript:;' }}" class="btn btn-secondary btn-sm"><i class="bx bx-caret-left-circle"></i></a>
                        <a href="{{ (isset($next))?$next:'javascript:;' }}" class="btn btn-secondary btn-sm"><i class="bx bx-caret-right-circle"></i></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('permission.list') }}" class="btn btn-secondary btn-sm" style="float: right;">Back</a>
                </div>
            </div>
        </div>
    </div>
    <hr/>
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="permissions" action="{{ route('permission.update',$permission->id) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label class="col-sm-4 form-label">Permission Group: </label>  
                                            <div class="col-sm-8 form-group">
                                                <select class="single-select" name="group_id">
                                                    <option value="0">Select</option>
                                                    @foreach ($groups as $item)
                                                        <option value="{{$item->id}}" {{ $item->id == $permission->group_id?'selected':'' }}>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-4">Permission Name: <span class="text-danger">*</span></label>
                                            <div class="col-sm-8 form-group">
                                                <input type="text" class="form-control" value="{{ $permission->name }}" name="name"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    </div><hr>                                
                                    <div class="col-md-6">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="submit" value="Save" class="btn btn-rounded btn-success" style="float: right;">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function (){
        var validator;
        $.validator.addMethod("valueNotEquals", function(value, element, arg){
            return arg !== value;
        }, "This field is required");
        $('#permissions').validate({
            rules: {
                // group_id: {
                //     required : true,
                //     valueNotEquals: "0",
                // },
                name: {
                    required : true,
                }, 
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });  
</script>
@endsection