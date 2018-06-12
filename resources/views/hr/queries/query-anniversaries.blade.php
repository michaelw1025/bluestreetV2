@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Anniversary<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button>@if(isset($employees)) <button type="button" class="mr-2 btn btn-success pl- pr-3 float-right btn-lg excel-export prevent-print" onclick="location.href='{{ url('hr.export-employees-anniversary/'.$searchMonth.'/'.$searchYear) }}'">Export To Excel</button> @endif</h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')
        <form method="get" action="{{url('hr.query-anniversaries')}}">
        {{ csrf_field() }}
        <div class="form-row align-items-center">
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="search_month">Month</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Month</div>
                    </div>
                    <select class="form-control" name="search_month" required>
                        <option></option>
                        @for($i = 1; $i <= 12; $i++)
                        <option {{ isset($searchMonth) ? ($searchMonth == $i ? 'selected' : '') : old('search_month') }} value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('search_month') }}</small>
            </div>
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="search_year">Year</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Year</div>
                    </div>
                    <select class="form-control" name="search_year" required>
                        <option></option>
                        @for($i = 2015; $i <= 2025; $i++)
                        <option {{ isset($searchYear) ? ($searchYear == $i ? 'selected' : '') : old('search_year') }} value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('search_year') }}</small>
            </div>
            <button type="submit" class="btn btn-outline-success prevent-print" name="submit_anniversary_search" value="search">Search</button>
        </div>
        </form>

        <hr class="border-info prevent-print"/>

        <button type="button" class="btn btn-outline-primary mr-2 prevent-print anniversary-column" id="five">5 YRS</button>
        <button type="button" class="btn btn-outline-primary mr-2 prevent-print anniversary-column" id="ten">10 YRS</button>
        <button type="button" class="btn btn-outline-primary mr-2 prevent-print anniversary-column" id="fifteen">15 YRS</button>
        <button type="button" class="btn btn-outline-primary mr-2 prevent-print anniversary-column" id="twenty">20 YRS</button>
        <button type="button" class="btn btn-outline-primary mr-2 prevent-print anniversary-column" id="twenty-five">25 YRS</button>
        <button type="button" class="btn btn-outline-primary mr-2 prevent-print anniversary-column" id="thirty">30 YRS</button>
        <button type="button" class="btn btn-outline-primary mr-2 prevent-print anniversary-column" id="thirty-five">35 YRS</button>
        <button type="button" class="btn btn-outline-primary mr-2 prevent-print anniversary-column" id="forty">40 YRS</button>
        <button type="button" class="btn btn-outline-primary mr-2 prevent-print anniversary-column" id="forty-five">45 YRS</button>
        <button type="button" class="btn btn-outline-primary mr-2 prevent-print anniversary-column" id="fifty">50 YRS</button>

        <hr class="border-info prevent-print"/>

        @if(isset($employees))
            <table class="table table-sm table-bordered table-hover mt-4">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Hire Date</th>
                        <th scope="col">Cost Center</th>
                        <th scope="col">Shift</th>
                        <th scope="col">Team Manager</th>
                        <th scope="col">Team Leader</th>
                    </tr>
                </thead>
                <tbody>
                    @php $years = array('5', '10', '15', '20', '25', '30', '35', '40', '45', '50') @endphp
                    @foreach($years as $year)
                    <tr class="d-none {{ $year == '5' ? 'five' : ($year == '10' ? 'ten' : ($year == '15' ? 'fifteen' : ($year == '20' ? 'twenty' : ($year == '25' ? 'twenty-five' : ($year == '30' ? 'thirty' : ($year == '35' ? 'thirty-five' : ($year == '40' ? 'forty' : ($year == '45' ? 'forty-five' : ($year == '50' ? 'fifty' : ''))))))))) }}">
                        <td colspan="5" class="text-center table-info">{{$year}} Years</td>
                    </tr>
                    @foreach($employees as $employee)
                    @if($employee->diff == $year)
                    <tr class="clickable-row d-none {{ $year == '5' ? 'five' : ($year == '10' ? 'ten' : ($year == '15' ? 'fifteen' : ($year == '20' ? 'twenty' : ($year == '25' ? 'twenty-five' : ($year == '30' ? 'thirty' : ($year == '35' ? 'thirty-five' : $year == '40' ? 'forty' : ($year == '45' ? 'forty-five' : ($year == '50' ? 'fifty' : '')))))))) }}" data-href="{{ url('hr.employees/'.$employee->id) }}">
                        <td>{{$employee->first_name}} {{$employee->last_name}}</td>
                        <td>{{$employee->hire_date->format('m-d-Y')}}</td>
                        <!-- <td>@foreach($costCenters as $costCenter) {{$employee->costCenter[0]->id == $costCenter->id ? $costCenter->number : ''}} @endforeach</td> -->
                        <td>@foreach($employee->costCenter as $costCenter) {{$costCenter->number}} @endforeach</td>
                        <td>@foreach($employee->shift as $shift) {{$shift->description}} @endforeach</td>
                        <td>{{$employee->team_manager}}</td>
                        <td>{{$employee->team_leader}}</td>
                    </tr>
                    @endif
                    @endforeach
                    @endforeach

                <tbody>
            </table>
        @endif
    </div>
</div>
@endsection
