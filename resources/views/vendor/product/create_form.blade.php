@extends('vendor.vendor_dashboard')
@section('vendor')
@php
    $role = Auth::user()->role;
@endphp
<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
<div class="page-content">
    <div class="row">
        <div class="col-sm-6">
            <h6 class="mb-0 text-uppercase">Product</h6>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('vendor.product.list') }}" class="btn btn-secondary btn-sm" style="float: right;">Back</a>
        </div>
    </div>
    <hr />
    <div class="card">
        <div class="card-body p-4">
            <form id="product_form" action="{{ route('vendor.product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="border border-3 p-4 rounded">
                                <div class="mb-3 form-group">
                                    <label for="inputProductTitle" class="form-label">Product Name: <span class="text-danger">*</span></label>
                                    <input type="text" name="product_name" class="form-control" id="inputProductTitle" placeholder="Enter product name">
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="form-label">Product Tags</label>
                                            <input type="text" name="product_tags" class="form-control" data-role="tagsinput">
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="form-label">Product Size</label>
                                            <input type="text" name="product_size" class="form-control" data-role="tagsinput">
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="form-label">Product Color</label>
                                            <input type="text" name="product_color" class="form-control" data-role="tagsinput">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="inputProductDescription" class="form-label">Short Description</label>
                                    <textarea class="form-control" name="short_desc" id="inputProductDescription" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="inputProductDescription" class="form-label">Long Description</label>
                                    </textarea><textarea id="mytextarea" name="long_desc"></textarea>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <label for="inputProductDescription" class="form-label">Product Image</label>
                                            <input name="product_thumbnail" type="file" id="image" class="form-control">
                                        </div>
                                        <div class="col-sm-4">
                                            <img src="{{url('upload/blank1.png')}}" id="showImg"
                                                style="width: 100px; height:100px; margin-top:15px; float: right;">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="inputProductDescription" class="form-label">Multiple Images</label>
                                    <input type="file" name="multi_img[]" class="form-control" id="multiImg" multiple><br>
                                    <div class="row" id="preview_img"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="border border-3 p-4 rounded">
                                <div class="row g-3">
                                    <div class="col-md-6 form-group">
                                        <label for="inputPrice" class="form-label">Price: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="selling_price" id="inputPrice" placeholder="00.00">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCompareatprice" class="form-label">Discount Price:</label>
                                        <input type="text" class="form-control" name="discount_price" id="inputCompareatprice" placeholder="00.00">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="inputCostPerPrice" class="form-label">Product Code: <span class="text-danger">*</span></label>
                                        <input type="text" name="product_code" class="form-control" id="inputCostPerPrice" placeholder="00.00">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="inputStarPoints" class="form-label">Product Qty: <span class="text-danger">*</span></label>
                                        <input type="text" name="product_qty" autofocus="off" class="form-control" id="inputStarPoints" placeholder="00.00">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputProductType" class="form-label">Product Brand</label>
                                        <select class="single-select" name="brand_id">
                                            <option value="0">Select</option>
                                            @foreach ($data['brands'] as $brand)
                                            <option value="{{$brand->id}}">{{ $brand->brand_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="inputProductType" class="form-label">Category</label>
                                        @php
                                        $categories = isset($data['categories'])?$data['categories']:'';
                                        @endphp
                                        <select data-placeholder="Select a category..." class="single-select" id="subcategory_id" name="subcategory_id">
                                            <option value="0" selected disabled>Select</option>
                                            @foreach($categories as $cat)
                                            <optgroup label="{{$cat->category_name}}">
                                                @if(count($cat->sub_cat)>0)
                                                @foreach($cat->sub_cat as $c)
                                                <option value="{{$c->id}}">&nbsp;&nbsp;{{ $c->subcategory_name }} </option>
                                                @endforeach
                                                @endif
                                            </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <div class="row g-3">
                                            <div class="col-sm-6">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="hot_deals">
                                                <label for="inputProductType" class="form-label">Hot Deals</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="featured">
                                                <label for="inputProductType" class="form-label">Featured</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row g-3">
                                            <div class="col-sm-6">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="special_deals">
                                                <label for="inputProductType" class="form-label">Special Deal</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="special_offer">
                                                <label for="inputProductType" class="form-label">Special Offer</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row g-3">
                                            <div class="col-sm-6">
                                                <label for="inputProductType" class="form-label">Status</label>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="status" checked="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <input type="submit" class="btn btn-primary" value="Save Product">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#image').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showImg').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
{{-- Multi Image JS --}}
<script>
    $(document).ready(function () {
        $('#multiImg').on('change', function () { //on file input change
            if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data    
                $.each(data, function (index, file) { //loop though each file
                    if (/(\.|\/)(gif|jpe?g|png|webp|avif)$/i.test(file.type)) { //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function (file) { //trigger function on successful read
                            return function (e) {
                                var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(100)
                                    .height(80); //create image element 
                                $('#preview_img').append(img); //append image to output element
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });
            } else {
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        var validator;
        $.validator.addMethod("valueNotEquals", function(value, element, arg){
            return arg !== value;
        }, "This field is required");
        $('#product_form').validate({
            rules: {
                product_name: {
                    required: true,
                },
                product_code: {
                    required: true,
                },
                selling_price: {
                    required: true,
                },
                product_qty: {
                    required: true,
                },
                subcategory_id: {
                    required: true,
                    valueNotEquals: "0",
                },
            },
            messages: {
                product_name: {
                    required: 'Please Enter Name',
                },
                subcategory_id: {
                    required: 'Please Select Category',
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });  
</script>
@endsection