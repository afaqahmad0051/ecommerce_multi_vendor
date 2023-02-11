@extends('admin.admin_dashboard')
@section('title')
Product
@endsection
@section('admin')
@php
    $count = App\Models\Product::count();
@endphp
<div class="page-content">
    <div class="row">
        <div class="col-md-6">
            <h6 class="mb-0 text-uppercase">Product <span class="badge rounded-pill bg-info">{{ $count }}</span></h6>
        </div>
        <div class="col-md-6">
            <a href="{{ route('product.create') }}" class="btn btn-success btn-sm" style="float: right;">Create</a>
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
                            <th width="20%">Actions</th>
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
                                <td>
                                    <a href="{{ route('product.edit',$item->id) }}" class="btn btn-info btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('product.delete',$item->id) }}" class="btn btn-danger btn-sm" title="Delete" id="delete"><i class="fa fa-trash"></i></a>
                                    <a href="{{ route('category.edit',$item->id) }}" class="btn btn-success btn-sm" title="Details"><i class="fa fa-eye"></i></a>
                                    @if ($item->status == 1)
                                        <a href="{{ route('product.inactive',$item->id) }}" class="btn btn-warning btn-sm" title="Inactive"><i class="fa-solid fa-thumbs-down"></i></a>
                                    @else
                                        <a href="{{ route('product.active',$item->id) }}" class="btn btn-warning btn-sm" title="Active"><i class="fa-solid fa-thumbs-up"></i></a>
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
                            <th width="20%">Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection