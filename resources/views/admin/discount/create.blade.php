@extends('admin.admin_dashboard')
@section('title')
    Coupon
@endsection
@section('admin')
<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
<div class="page-content">
    <div class="row">
        <div class="col-md-6">
            <h6 class="mb-0 text-uppercase">Coupon</h6>
        </div>
        <div class="col-md-6">
            <a href="{{ route('coupon.list') }}" class="btn btn-secondary btn-sm" style="float: right;">Back</a>
        </div>
    </div>
    <hr/>
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="coupon" action="{{ route('coupon.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label class="col-sm-4 form-label">Coupon Code: <span class="text-danger">*</span></label>  
                                            <div class="col-sm-8 form-group">
                                                <input type="text" class="form-control" name="coupon_name"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-4 form-label">Coupon Discount(%): <span class="text-danger">*</span></label>  
                                            <div class="col-sm-8 form-group">
                                                <input type="text" class="form-control" name="coupon_discount"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-4 form-label">Coupon Validity: <span class="text-danger">*</span></label>  
                                            <div class="col-sm-8 form-group">
                                                <input type="date" class="form-control" name="coupon_validity" id="coupon_validity"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-4">Status: </label>
                                            <div class="col-sm-8">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="status" checked="">
                                                </div>
                                            </div>
                                        </div>
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
        $('#coupon').validate({
            rules: {
                coupon_name: {
                    required : true,
                }, 
                coupon_discount: {
                    required : true,
                },
                coupon_validity: {
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
<script>
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;
    console.log(today);
    $('#coupon_validity').attr('min',today);
</script>
@endsection