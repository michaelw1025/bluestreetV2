@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Hire Date<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')
        <form method="get" action="{{url('hr.query-hire-date')}}">
        {{ csrf_field() }}
        <div class="form-row align-items-center">
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="search_begin_date">Begin Date</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Begin Date</div>
                    </div>
                    <input type="text" class="form-control ui-datepicker-prev date-pick" name="search_begin_date" value="{{ isset($beginSearchDate) ? $beginSearchDate->format('m-d-Y') : old('search_begin_date') }}">
                </div>
                <small class="text-danger">{{ $errors->first('search_begin_date') }}</small>
            </div>
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="search_end_date">End Date</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">End Date</div>
                    </div>
                    <input type="text" class="form-control ui-datepicker-prev date-pick" name="search_end_date" value="{{isset($endSearchDate) ? $endSearchDate->format('m-d-Y') : old('search_end_date') }}">
                </div>
                <small class="text-danger">{{ $errors->first('search_end_date') }}</small>
            </div>
            <button type="submit" class="btn btn-outline-success prevent-print" name="submit_hire_date_search" value="search">Search</button>
        </div>
        </form>

        <hr class="border-info prevent-print"/>

        @if(isset($employees))
            <table class="table table-sm table-striped table-bordered table-hover mt-4">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Hire Date</th>
                        <th scope="col">Term Date</th>
                        <th scope="col">Cost Center</th>
                        <th scope="col">Team Manager</th>
                        <th scope="col">Team Leader</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                @foreach($employee->termination as $termination)
                    <tr class="clickable-row" data-href="{{ url('hr.employees/'.$employee->id) }}">
                        <td>{{$employee->first_name}} {{$employee->last_name}}</td>
                        <td>{{$employee->hire_date->format('m-d-Y')}}</td>
                        <td>{{$termination->date->format('m-d-Y')}}</td>
                        <td>@foreach($costCenters as $costCenter) {{$employee->costCenter[0]->id == $costCenter->id ? $costCenter->number : ''}} @endforeach</td>
                        <td>{{$employee->team_manager}}</td>
                        <td>{{$employee->team_leader}}</td>
                    </tr>
                @endforeach
                @endforeach
                <tbody>
            </table>
        @endif
    </div>
</div>
@endsection