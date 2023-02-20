@php
    // $product = isset($data['product'])?$data['product']:'';
@endphp
<div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModal"></button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                        <div class="detail-gallery">
                            <!-- MAIN SLIDES -->
                            <img src="" id="pimage" alt="product image" />
                        </div>
                        <!-- End Gallery -->
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="detail-info pr-30 pl-30">
                            <span class="stock-status out-stock"> Sale Off </span>
                            <h3 class="title-detail"><a href="" id="pname" class="text-heading"></a></h3>
                            <div class="attr-detail attr-size mb-30" id="sizeArea">
                                <strong class="mr-10" style="width: 60px;">Size: </strong>
                                <div class="custom_select">
                                    <select class="form-control select-active" id="size" name="size" style="width: 10rem;">
                                        
                                    </select>
                                </div>
                            </div>

                            <div class="attr-detail attr-size mb-30" id="colorArea">
                                <strong class="mr-10" style="width: 60px;">Color: </strong>
                                <div class="custom_select">
                                    <select class="form-control select-active" id="color" name="color" style="width: 10rem;">
                                        
                                    </select>
                                </div>
                            </div>

                            <div class="clearfix product-price-cover">
                                <div class="product-price primary-color float-left">
                                    <span class="current-price text-brand" id="pprice"></span>
                                    <span>
                                        <span class="old-price font-md ml-15" id="oldprice"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="detail-extralink mb-30" id="user_bargain">
                                <div class="user-offer border radius">
                                    <input type="text" name="user_offer" class="qty-val user_offer" id="user_offer" placeholder="Enter your offer">
                                </div>
                            </div>
                            <div class="detail-extralink mb-30">
                                <div class="detail-qty border radius">
                                    <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                    <input type="text" name="qty" id="qty" class="qty-val" value="1" min="1">
                                    <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                </div>
                                <div class="product-extra-link2">
                                    <input type="hidden" id="product_id">
                                    <button type="submit" class="button button-add-to-cart" onclick="addToCart()"><i class="fi-rs-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="font-xs">
                                        <ul>
                                            <li class="mb-5">Product Code: <span class="text-brand" id="pcode"></span></li>
                                            <li class="mb-5">Category:<span class="text-brand" id="pcategory"></span></li>
                                            <li class="mb-5">Vendor:<span class="text-brand" id="pvendor_id"></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="font-xs">
                                        <ul>
                                            <li class="mb-5">Brand: <span class="text-brand" id="pbrand"></span></li>
                                            <li class="mb-5">Stock:
                                                <span class="badge badge-pill badge-success" id="stock_in" style="background: green; color:white;"> Jun 4.2022</span>
                                                <span class="badge badge-pill badge-danger" id="stock_out" style="background: red; color:white;"> Jun 4.2022</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Detail Info -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>