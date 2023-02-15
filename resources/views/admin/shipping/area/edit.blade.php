@extends('admin.admin_dashboard')
@section('title')
Area
@endsection
@php
    $country = isset($data['country'])?$data['country']:'';
    $city = isset($data['city'])?$data['city']:'';
    $area = isset($data['area'])?$data['area']:'';
@endphp
@section('admin')
<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
<div class="page-content">
    <div class="row">
        <div class="col-md-6">
            <h6 class="mb-0 text-uppercase">Area</h6>
        </div>
        <div class="col-md-6">
            <a href="{{ route('area.list') }}" class="btn btn-secondary btn-sm" style="float: right;">Back</a>
        </div>
    </div>
    <hr/>
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="area" action="{{ route('area.update',$area->id) }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label class="col-sm-4 form-label">City: <span class="text-danger">*</span></label>  
                                            <div class="col-sm-8 form-group">
                                                @php
                                                $countries = isset($data['country'])?$data['country']:'';
                                                @endphp
                                                <select data-placeholder="Select a city..." class="single-select" id="city_id" name="city_id">
                                                    <option value="0" selected disabled>Select</option>
                                                    @foreach($countries as $country)
                                                    <optgroup label="{{$country->country_name}}">
                                                        @if(count($country->city)>0)
                                                        @foreach($country->city->sortBy('city_name') as $c)
                                                        <option value="{{$c->id}}" {{ $area->city_id==$c->id?'selected':'' }}>&nbsp;&nbsp;{{ $c->city_name }} </option>
                                                        @endforeach
                                                        @endif
                                                    </optgroup>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-4">Area Name: <span class="text-danger">*</span></label>
                                            <div class="col-sm-8 form-group">
                                                <input type="text" class="form-control" name="area_name" value="{{ $area->area_name }}"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-4">Status: </label>
                                            <div class="col-sm-8">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="status" {{$area->status==1?"checked":""}}>
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
        var validator;
        $.validator.addMethod("valueNotEquals", function(value, element, arg){
            return arg !== value;
        }, "This field is required");
        $('#area').validate({
            rules: {
                city_id: {
                    required : true,
                    valueNotEquals: "0",
                }, 
                area_name: {
                    required : true,
                }, 
            },
            messages :{
                city_id: {
                    required : 'Please Select City',
                },
                area_name: {
                    required : 'Please Enter Area',
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