@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Birthdays<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')
        <form method="get" action="{{url('hr.query-birthdays')}}">
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
            <button type="submit" class="btn btn-outline-success prevent-print" name="submit_birthday_search" value="search">Search</button>
        </div>
        </form>

        <hr class="border-info prevent-print"/>

        @if(isset($employees))
            <table class="table table-sm table-striped table-bordered table-hover mt-4">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Birth Date</th>
                        <th scope="col">Hire Date</th>
                        <th scope="col">Cost Center</th>
                        <th scope="col">Job</th>
                        <th scope="col">Position</th>
                        <th scope="col">Shift</th>
                        <th scope="col">Team Manager</th>
                        <th scope="col">Team Leader</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)

                    <tr class="clickable-row" data-href="{{ url('hr.employees/'.$employee->id) }}">
                        <td>{{$employee->first_name}} {{$employee->last_name}}</td>
                        <td>{{$employee->birth_date->format('m-d-Y')}}</td>
                        <td>{{$employee->hire_date->format('m-d-Y')}}</td>
                        <td>@foreach($employee->costCenter as $costCenter) {{$costCenter->number}} @endforeach</td>
                        <td>@foreach($employee->job as $job) {{$job->description}} @endforeach</td>
                        <td>@foreach($employee->position as $position) {{$position->description}} @endforeach</td>
                        <td>@foreach($employee->shift as $shift) {{$shift->description}} @endforeach</td>
                        <td>{{$employee->team_manager}}</td>
                        <td>{{$employee->team_leader}}</td>
                    </tr>

                @endforeach
                <tbody>
            </table>
        @endif
    </div>
</div>
@endsection