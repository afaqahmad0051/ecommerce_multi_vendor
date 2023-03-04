@extends('admin.admin_dashboard')
@section('title')
Reporting
@endsection
@section('admin')
<div class="page-content">
    <div class="row">
        <div class="col-md-6">
            <h6 class="mb-0 text-uppercase">Reporting</h6>
        </div>
        {{-- <div class="col-md-6">
            <a href="{{ route('category.create') }}" class="btn btn-success btn-sm" style="float: right;">Create</a>
        </div> --}}
    </div>
    <hr/>
    <div class="row row-cols-1 row-cols-md-1 row-cols-lg-6 row-cols-xl-2">
        <form action="{{ route('report.user') }}" method="post">
            @csrf
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Search By User</h5>
                        <label class="form-label">Date:</label>
                        <select name="user" class="single-select select2-hidden-accessible" data-select2-id="3" tabindex="-1" aria-hidden="true">
                            <option value="0" data-select2-id="0">Select User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" data-select2-id="{{ $user->id }}"> {{ strtoupper($user->name) }}</option>
                            @endforeach
                        </select>
                        <br>
                        <input type="submit" class="btn btn-rounded btn-sm btn-primary" value="Search" style="float: right;">
                    </div>
                </div>
            </div>
        </form>
        <form action="{{ route('report.date') }}" method="post">
            @csrf
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Search By Date</h5>
                        <label class="form-label">Date:</label>
                        <input type="date" name="date" class="form-control">
                        <br>
                        <input type="submit" class="btn btn-rounded btn-sm btn-primary" value="Search" style="float: right;">
                    </div>
                </div>
            </div>
        </form>
        <form action="{{ route('report.month') }}" method="post">
            @csrf
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Search By Month</h5>
                        <label class="form-label">Select Month:</label>
                        <select name="month_name" class="single-select" data-select2-id="2" tabindex="-1" aria-hidden="true">
                            <option value="" data-select2-id="">Select Month</option>
                            <option value="January" data-select2-id="January">January</option>
                            <option value="February" data-select2-id="February">February</option>
                            <option value="March" data-select2-id="March">March</option>
                            <option value="April" data-select2-id="April">April</option>
                            <option value="May" data-select2-id="May">May</option>
                            <option value="June" data-select2-id="June">June</option>
                            <option value="July" data-select2-id="July">July</option>
                            <option value="August" data-select2-id="August">August</option>
                            <option value="September" data-select2-id="September">September</option>
                            <option value="October" data-select2-id="October">October</option>
                            <option value="November" data-select2-id="November">November</option>
                            <option value="December" data-select2-id="December">December</option>
                        </select><br>
                        <label class="form-label">Select Year:</label>
                        <select name="year_name" class="single-select" data-select2-id="4" tabindex="-1" aria-hidden="true">
                            <option value="0" data-select2-id="0">Select Year</option>
                            <option value="2023" data-select2-id="2023">2023</option>
                            <option value="2022" data-select2-id="2022">2022</option>
                            <option value="2021" data-select2-id="2021">2021</option>
                            <option value="2020" data-select2-id="2020">2020</option>
                            <option value="2019" data-select2-id="2019">2019</option>
                            <option value="2018" data-select2-id="2018">2018</option>
                            <option value="2017" data-select2-id="2017">2017</option>
                            <option value="2016" data-select2-id="2016">2016</option>
                            <option value="2015" data-select2-id="2015">2015</option>
                        </select>

                        <br>
                        <input type="submit" class="btn btn-rounded btn-sm btn-primary" value="Search" style="float: right;">
                    </div>
                </div>
            </div>
        </form>
        <form action="{{ route('report.year') }}" method="post">
            @csrf
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Search By Year</h5>
                        <label class="form-label">Select Year:</label>
                        <select name="year" class="single-select select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true">
                            <option value="0" data-select2-id="0">Select Year</option>
                            <option value="2023" data-select2-id="2023">2023</option>
                            <option value="2022" data-select2-id="2022">2022</option>
                            <option value="2021" data-select2-id="2021">2021</option>
                            <option value="2020" data-select2-id="2020">2020</option>
                            <option value="2019" data-select2-id="2019">2019</option>
                            <option value="2018" data-select2-id="2018">2018</option>
                            <option value="2017" data-select2-id="2017">2017</option>
                            <option value="2016" data-select2-id="2016">2016</option>
                            <option value="2015" data-select2-id="2015">2015</option>
                        </select>
                        <br>
                        <input type="submit" class="btn btn-rounded btn-sm btn-primary" value="Search" style="float: right;">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection