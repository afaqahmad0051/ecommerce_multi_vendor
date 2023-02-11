@extends('admin.admin_dashboard')
@section('title')
    Inactive Vendors
@endsection
@section('admin')
<div class="page-content">
    <div class="row">
        <div class="col-md-6">
            <h6 class="mb-0 text-uppercase">InActive Vendors</h6>
        </div>
        <div class="col-md-6">
        </div>
    </div>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sr.</th>
                            <th>Shop Name</th>
                            <th>Vendor Name</th>
                            <th>Joinig Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($InactiveVendor as $key => $item)
                            @php
                            $day_name = date('D', strtotime(trim(str_replace('/','-',$item->created_at))));
                            $date = date('d-m-Y', strtotime(trim(str_replace('/','-',$item->created_at))));
                            $time =  date('h:i A', strtotime(trim(str_replace('/','-',$item->created_at))));
                            @endphp
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $date }} {{ $time }}</td>
                                <td>
                                <span class="badge rounded-pill bg-danger">{{$item->status}}</span>
                                </td>
                                <td>
                                    <a href="{{ route('vendor.details',$item->id) }}" class="btn btn-info">Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Sr.</th>
                            <th>Shop Name</th>
                            <th>Vendor Name</th>
                            <th>Joinig Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection