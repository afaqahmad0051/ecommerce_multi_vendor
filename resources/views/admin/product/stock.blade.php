@extends('admin.admin_dashboard')
@section('title')
Stock
@endsection
@section('admin')
<div class="page-content">
    <div class="row">
        <div class="col-md-6">
            <h6 class="mb-0 text-uppercase">Stock </h6>
        </div>
    </div>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="10%">Sr.</th>
                            <th width="30%">Image</th>
                            <th width="20%">Name</th>
                            <th width="6%">Price</th>
                            <th width="6%">Qty</th>
                            <th width="6%">Discount Price</th>
                            <th width="6%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $item)                            
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    <img src="{{ asset($item->product_thumbnail) }}" alt="{{ $item->product_name }}" style="width: 70px; height: 40px;">
                                </td>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->selling_price }}</td>
                                <td>{{ $item->product_qty }}</td>
                                <td>
                                    @if ($item->discount_price == null)
                                        <span class="badge rounded-pill bg-primary">No Discount</span>                                        
                                    @else
                                        @php
                                            $amount = $item->selling_price - $item->discount_price;
                                            $discount = ($amount/$item->selling_price)*100;
                                        @endphp
                                        {{ $item->discount_price }} <span class="badge rounded-pill bg-primary">{{ round($discount) }}%</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status == 1)
                                        <span class="badge rounded-pill bg-success">Active</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th width="10%">Sr.</th>
                            <th width="30%">Image</th>
                            <th width="20%">Name</th>
                            <th width="6%">Price</th>
                            <th width="6%">Qty</th>
                            <th width="6%">Discount Price</th>
                            <th width="6%">Status</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection