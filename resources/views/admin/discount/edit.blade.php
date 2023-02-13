@extends('admin.admin_dashboard')
@section('title')
    Coupon
@endsection
@section('admin')
<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
<div class="page-content">
    <div class="row">
        <div class="col-sm-6">
            <h6 class="mb-0 text-uppercase">Coupon</h6>
        </div>
        <div class="col-sm-6">
            @php
                $next = App\Models\Coupan::where('id', '>', $coupon->id)->min('id');
                $previous = App\Models\Coupan::where('id', '<', $coupon->id)->max('id');
            @endphp
            <div class="row">
                <div class="col-md-10">
                    <div class="btn-group" role="group" style="float: right;">
                        <a href="{{ (isset($previous))?$previous:'javascript:;' }}" class="btn btn-secondary btn-sm"><i class="bx bx-caret-left-circle"></i></a>
                        <a href="{{ (isset($next))?$next:'javascript:;' }}" class="btn btn-secondary btn-sm"><i class="bx bx-caret-right-circle"></i></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('coupon.list') }}" class="btn btn-secondary btn-sm" style="float: right;">Back</a>
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
                            <form id="coupon" action="{{ route('coupon.update',$coupon->id) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label class="col-sm-4 form-label">Coupon Code: <span class="text-danger">*</span></label>  
                                            <div class="col-sm-8 form-group">
                                                <input type="text" class="form-control" value="{{ $coupon->coupon_name }}" name="coupon_name"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-4 form-label">Coupon Discount(%): <span class="text-danger">*</span></label>  
                                            <div class="col-sm-8 form-group">
                                                <input type="text" class="form-control" value="{{ $coupon->coupon_discount }}" name="coupon_discount"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-4 form-label">Coupon Validity: <span class="text-danger">*</span></label>  
                                            <div class="col-sm-8 form-group">
                                                <input type="date" class="form-control" name="coupon_validity" value="{{ $coupon->coupon_validity }}" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-4">Status: </label>
                                            <div class="col-sm-8">
                                                <div class="form-check form-switch">
                                                    @if ($coupon->status == 1)
                                                        <input class="form-check-input" checked type="checkbox" id="flexSwitchCheckChecked" name="status">
                                                    @else
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="status">
                                                    @endif
                                                </div>
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
@endsection