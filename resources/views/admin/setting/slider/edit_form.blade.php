@extends('admin.admin_dashboard')
@section('title')
    Slider
@endsection
@section('admin')
<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
<div class="page-content">
    <div class="row">
        <div class="col-sm-6">
            <h6 class="mb-0 text-uppercase">Slider</h6>
        </div>
        <div class="col-sm-6">
            @php
                $next = App\Models\Slider::where('id', '>', $slider->id)->min('id');
                $previous = App\Models\Slider::where('id', '<', $slider->id)->max('id');
            @endphp
            <div class="row">
                <div class="col-md-10">
                    <div class="btn-group" role="group" style="float: right;">
                        <a href="{{ (isset($previous))?$previous:'javascript:;' }}" class="btn btn-secondary btn-sm"><i class="bx bx-caret-left-circle"></i></a>
                        <a href="{{ (isset($next))?$next:'javascript:;' }}" class="btn btn-secondary btn-sm"><i class="bx bx-caret-right-circle"></i></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('slider.list') }}" class="btn btn-secondary btn-sm" style="float: right;">Back</a>
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
                            <form id="slider" action="{{ route('slider.update',$slider->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="old_image" value="{{ $slider->slider_image }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label class="col-sm-4 form-label">Slider Title: <span class="text-danger">*</span></label>  
                                            <div class="col-sm-8 form-group">
                                                <input type="text" class="form-control" value="{{ $slider->slider_title }}" name="slider_title"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-4 form-label">Slider Short Title: <span class="text-danger">*</span></label>  
                                            <div class="col-sm-8 form-group">
                                                <input type="text" class="form-control" value="{{ $slider->slider_short_title }}" name="slider_short_title"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-4">Slider Image: </label>
                                            <div class="col-sm-8">
                                                <input class="form-control" type="file" name="photo" id="image">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="col-sm-4">Status: </label>
                                            <div class="col-sm-8">
                                                <div class="form-check form-switch">
                                                    @if ($slider->status == 1)
                                                        <input class="form-check-input" checked type="checkbox" id="flexSwitchCheckChecked" name="status">
                                                    @else
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="status">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        @if ($slider->slider_image != null)
                                            <img class="rounded avatar-lg" id="showImg" src=" {{ asset($slider->slider_image) }}" style="float: right; heigt:100px; width:100px;">
                                        @else
                                            <img class="rounded avatar-lg" id="showImg" src=" {{ url('upload/blank1.png') }}" style="float: right; heigt:100px; width:100px;">
                                        @endif
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
<script>
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImg').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function (){
        $('#slider').validate({
            rules: {
                slider_title: {
                    required : true,
                },
                slider_short_title: {
                    required : true,
                },
            },
            messages :{
                slider_title: {
                    required : 'Please Enter Title',
                },
                slider_short_title: {
                    required : 'Please Enter Short Title',
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