<style>
    body{
        /* background-color: #eeeeee; */
    }
    .card{
        background-color: #ffffff;
        padding: 15px;
        border: none;
    }
    .input-box{
        position: relative;
    }
    .input-box i{
        position: absolute;
        right: 13px;
        top: 15px;
        color: #ced4da;
    }
    .form-control{
        height: 50px;
        background-color: #eeeeee69;
    }
    .form-control:focus{
        background-color: #eeeeee69;
        box-shadow: none;
        border-color: #eeeeee;
    }
    .list{
        padding-top: 20px;
        padding-bottom: 10px;
        display: flex;
        align-items: center;
    }
    .border-bottom{
        border-bottom: 2px solid #eeeeee;   
    }
    .list i{
        font-size: 19px;
        color: red;
    }
    .list small{
        color: #dedddd;
    }
</style>
@php
    $products = isset($data['products'])?$data['products']:'';
    // dd($products);
@endphp
@if ($products -> isEmpty())
    <h4 class="text-center text-danger">Product not found</h4>
@else
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    @foreach ($products as $item)
                        <a href="{{ route('product.details',[$item->product_slug, $item->id]) }}">
                            <div class="list border-bottom">
                                <img src="{{ asset($item->product_thumbnail) }}" alt="" style="width:40px;height:40px;">
                                <div class="d-flex flex-column ml-5" style="margin-left: 10px; font-size:16px;font-weight:bold;">
                                    <span>{{ $item->product_name }}</span><small>£{{ number_format($item->selling_price, 2, '.', ',') }}</small>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif