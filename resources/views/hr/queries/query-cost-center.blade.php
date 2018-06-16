@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Cost Center<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')
        <form method="get" action="{{url('hr.query-cost-center')}}">
        {{ csrf_field() }}
        <div class="form-row align-items-center">
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="search_cost_center">Cost Center</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Cost Center</div>
                    </div>
                    <select class="form-control" name="search_cost_center" required>
                        <option></option>
                        @foreach($costCenters as $costCenter)
                        <option {{ isset($searchCostCenter) ? ($searchCostCenter == $costCenter->id ? 'selected' : '') : old('search_cost_center') }} value="{{$costCenter->id}}">{{$costCenter->number}} - {{$costCenter->description}}</option>
                        @endforeach
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('search_cost_center') }}</small>
            </div>
            <button type="submit" class="btn btn-outline-success prevent-print" name="submit_cost_center_search" value="search">Search</button>
        </div>
        </form>

        <hr class="border-info prevent-print"/>

        @isset($employeeCostCenters)

        @foreach($employeeCostCenters as $costCenter)
        <ul class="list-group col-xl-6">
        @if($costCenter->employeeStaffManager->isNotEmpty())
        @foreach($costCenter->employeeStaffManager as $ccStaffManager)
            <li class="list-group-item list-group-item-primary h5"><span class="text-primary">Staff Manager:</span>&nbsp&nbsp  {{$ccStaffManager->first_name}} {{$ccStaffManager->last_name}}</li>
        @endforeach
        @endif
        @if($costCenter->employeeDayTeamManager->isNotEmpty())
        @foreach($costCenter->employeeDayTeamManager as $ccDayTeamManager)
            <li class="list-group-item list-group-item-info h5"><span class="text-info">Day Team Manager:</span>&nbsp&nbsp  {{$ccDayTeamManager->first_name}} {{$ccDayTeamManager->last_name}}</li>
        @endforeach
        @endif
        @if($costCenter->employeeNightTeamManager->isNotEmpty())
        @foreach($costCenter->employeeNightTeamManager as $ccNightTeamManager)
            <li class="list-group-item list-group-item-info h5"><span class="text-info">Night Team Manager:</span>&nbsp&nbsp  {{$ccNightTeamManager->first_name}} {{$ccNightTeamManager->last_name}}</li>
        @endforeach
        @endif
        @if($costCenter->employeeDayTeamLeader->isNotEmpty())
        @foreach($costCenter->employeeDayTeamLeader as $ccDayTeamLeader)
            <li class="list-group-item list-group-item-secondary h5"><span class="text-secondary">Day Team Leader:</span>&nbsp&nbsp  {{$ccDayTeamLeader->first_name}} {{$ccDayTeamLeader->last_name}}</li>
        @endforeach
        @endif
        @if($costCenter->employeeNightTeamLeader->isNotEmpty())
        @foreach($costCenter->employeeNightTeamLeader as $ccNightTeamLeader)
            <li class="list-group-item list-group-item-secondary h5"><span class="text-secondary">Night Team Leader:</span>&nbsp&nbsp  {{$ccNightTeamLeader->first_name}} {{$ccNightTeamLeader->last_name}}</li>
        @endforeach
        @endif

        </ul>
        @endforeach

            <table class="table table-sm table-striped table-bordered table-hover mt-4">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">ID</th>
                        <th scope="col" class="hire-date">Hire Date</th>
                        <th scope="col" class="birth-date">Birth Date</th>
                        <th scope="col" class="service-date">Service Date</th>
                        <th scope="col" class="shift">Shift</th>
                        <th scope="col" class="job">Job</th>
                        <th scope="col" class="position">Position</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($employeeCostCenters as $costCenter)
                @foreach($costCenter->employee as $employee)
                    <tr class="clickable-row" data-href="{{ url('hr.employees/'.$employee->id) }}">
                        <td>{{$employee->first_name}} {{$employee->last_name}}</td>
                        <td>{{$employee->id}}</td>
                        <td class="hire-date">{{$employee->hire_date->format('m-d-Y')}}</td>
                        <td class="birth-date">{{$employee->birth_date->format('m-d-Y')}}</td>
                        <td class="service-date">{{$employee->service_date->format('m-d-Y')}}</td>
                        @foreach($employee->shift as $employeeShift)
                        <td class="shift">{{$employeeShift->description}}</td>
                        @endforeach
                        @foreach($employee->job as $employeeJob)
                        <td class="job">{{$employeeJob->description}}</td>
                        @endforeach
                        @foreach($employee->position as $employeePosition)
                        <td class="position">{{$employeePosition->description}}</td>
                        @endforeach
                    </tr>
                @endforeach
                @endforeach
                <tbody>
            </table>
        @endisset
    </div>
</div>
@endsection
