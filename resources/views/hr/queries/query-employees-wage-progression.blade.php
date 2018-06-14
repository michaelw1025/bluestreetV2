@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Wage Progressions<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button>@if(isset($employees))<button type="button" class="mr-2 btn btn-success pl- pr-3 float-right btn-lg excel-export prevent-print" onclick="location.href='{{ url('hr.export-employees-wage-progressions/'.$searchMonth.'/'.$searchYear.'/'.$searchProgression) }}'" name="export-excel">Export To Excel</button>@endif</h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')

        <form method="get" action="{{url('hr.query-employees-wage-progression')}}">
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
                        <option {{ isset($searchMonth) ? ($searchMonth == 1 ? 'selected' : '') : old('search_month') }} value="1">January 01</option>
                        <option {{ isset($searchMonth) ? ($searchMonth == 2 ? 'selected' : '') : old('search_month') }} value="2">February 02</option>
                        <option {{ isset($searchMonth) ? ($searchMonth == 3 ? 'selected' : '') : old('search_month') }} value="3">March 03</option>
                        <option {{ isset($searchMonth) ? ($searchMonth == 4 ? 'selected' : '') : old('search_month') }} value="4">April 04</option>
                        <option {{ isset($searchMonth) ? ($searchMonth == 5 ? 'selected' : '') : old('search_month') }} value="5">May 05</option>
                        <option {{ isset($searchMonth) ? ($searchMonth == 6 ? 'selected' : '') : old('search_month') }} value="6">June 06</option>
                        <option {{ isset($searchMonth) ? ($searchMonth == 7 ? 'selected' : '') : old('search_month') }} value="7">July 07</option>
                        <option {{ isset($searchMonth) ? ($searchMonth == 8 ? 'selected' : '') : old('search_month') }} value="8">August 08</option>
                        <option {{ isset($searchMonth) ? ($searchMonth == 9 ? 'selected' : '') : old('search_month') }} value="9">September 09</option>
                        <option {{ isset($searchMonth) ? ($searchMonth == 10 ? 'selected' : '') : old('search_month') }} value="10">October 10</option>
                        <option {{ isset($searchMonth) ? ($searchMonth == 11 ? 'selected' : '') : old('search_month') }} value="11">November 11</option>
                        <option {{ isset($searchMonth) ? ($searchMonth == 12 ? 'selected' : '') : old('search_month') }} value="12">December 12</option>
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
                        @for($i = 2015; $i <= 2030; $i++)
                        <option {{ isset($searchYear) ? ($searchYear == $i ? 'selected' : '') : old('search_year') }} value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('search_year') }}</small>
            </div>
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="search_progression">Progression Month</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Progression Month</div>
                    </div>
                    <select class="form-control" name="search_progression" required>
                        <option></option>
                        @isset($wageProgressions)
                        @foreach($wageProgressions as $wageProgression)
                        <option {{ isset($searchProgression) ? ($searchProgression == $wageProgression->id ? 'selected' : '') : old('search_progression') }} value="{{$wageProgression->id}}">{{$wageProgression->month}}</option>
                        @endforeach
                        @endisset
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('search_progression') }}</small>
            </div>
            <button type="submit" class="btn btn-outline-success prevent-print ml-1 mt-1" name="submit_wage_event_search" value="search">Search</button>
        </div>
        </form>


        <hr class="border-info"/>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print alphabetical-column" id="ssn">SSN</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print alphabetical-column" id="hire-date">Hire Date</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print alphabetical-column" id="birth-date">Birth Date</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print alphabetical-column" id="service-date">Service Date</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print alphabetical-column" id="address">Address</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print alphabetical-column" id="bid-eligible">Bid Eligible</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print alphabetical-column" id="cost-center">Cost Center</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print alphabetical-column" id="shift">Shift</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print alphabetical-column" id="job">Job</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print alphabetical-column" id="position">Position</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print alphabetical-column" id="current-wage">Current Wage</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print alphabetical-column" id="next-wage">Next Wage</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print alphabetical-column" id="team-manager">Team Manager</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print alphabetical-column" id="team-leader">Team Leader</button>
        <hr class="border-info prevent-print"/>

        @if(isset($employees))
            <table class="table table-sm table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">ID</th>
                        <th scope="col">Progression Date</th>
                        <th scope="col" class="ssn d-none">SSN</th>
                        <th scope="col" class="hire-date d-none">Hire Date</th>
                        <th scope="col" class="birth-date d-none">Birth Date</th>
                        <th scope="col" class="service-date d-none">Service Date</th>
                        <th scope="col" class="address d-none">Address</th>
                        <th scope="col" class="bid-eligible d-none">Bid Eligible</th>
                        <th scope="col" class="cost-center d-none">Cost Center</th>
                        <th scope="col" class="shift d-none">Shift</th>
                        <th scope="col" class="job d-none">Job</th>
                        <th scope="col" class="position d-none">Position</th>
                        <th scope="col" class="current-wage d-none">Current Wage</th>
                        <th scope="col" class="next-wage d-none">Next Wage</th>
                        <th scope="col" class="team-manager d-none">Team Manager</th>
                        <th scope="col" class="team-leader d-none">Team Leader</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                    <tr class="clickable-row" data-href="{{ url('hr.employees/'.$employee->id) }}">
                        <td>{{$employee->first_name}} {{$employee->last_name}}</td>
                        <td>{{$employee->id}}</td>
                        @foreach($employee->wageProgression as $employeeProgressionDate)
                        <td>{{$employeeProgressionDate->pivot->date->format('m-d-Y')}}</td>
                        @endforeach
                        <td class="ssn d-none">{{$employee->ssn}}</td>
                        <td class="hire-date d-none">{{$employee->hire_date->format('m-d-Y')}}</td>
                        <td class="birth-date d-none">{{$employee->birth_date->format('m-d-Y')}}</td>
                        <td class="service-date d-none">{{$employee->service_date->format('m-d-Y')}}</td>
                        <td class="address d-none">{{$employee->address_1}} {{$employee->address_2}}, {{$employee->city}}, {{$employee->state}}, {{$employee->zip_code}}</td>
                        <td class="bid-eligible d-none">{{$employee->bid_eligible == '0' ? 'No' : 'Yes'}}</td>

                        @foreach($employee->costCenter as $employeeCostCenter)
                        <td class="cost-center d-none">{{$employeeCostCenter->number}}</td>
                        @endforeach
                        @foreach($employee->shift as $employeeShift)
                        <td class="shift d-none">{{$employeeShift->description}}</td>
                        @endforeach
                        @foreach($employee->job as $employeeJob)
                        <td class="job d-none">{{$employeeJob->description}}</td>
                        @endforeach
                        @foreach($employee->position as $employeePosition)
                        <td class="job d-none">{{$employeeJob->description}}</td>
                        <td class="position d-none">{{$employeePosition->description}}</td>
                        @endforeach
                        @foreach($employee->wageProgressionWageTitle as $employeeNextWage)
                        <td class="next-wage d-none">{{$employeeNextWage->amount}}</td>
                        @endforeach

                        <td class="team-manager d-none">{{$employee->team_manager}}</td>
                        <td class="team-leader d-none">{{$employee->team_leader}}</td>
                    </tr>
                @endforeach
                <tbody>
            </table>
        @endif
    </div>
</div>
@endsection
