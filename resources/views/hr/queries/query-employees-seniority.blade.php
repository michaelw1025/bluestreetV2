@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Seniority List Of Employees<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button><button type="button" class="mr-2 btn btn-success pl- pr-3 float-right btn-lg excel-export prevent-print" onclick="location.href='{{ url('hr.export-employees-seniority') }}'">Export To Excel</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print alphabetical-column" id="ssn">SSN</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print alphabetical-column" id="hire-date">Hire Date</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print alphabetical-column" id="birth-date">Birth Date</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print alphabetical-column" id="service-date">Service Date</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print alphabetical-column" id="address">Address</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print alphabetical-column" id="bid-eligible">Bid Eligible</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print alphabetical-column" id="vitality">Vitality</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print alphabetical-column" id="cost-center">Cost Center</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print alphabetical-column" id="shift">Shift</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print alphabetical-column" id="job">Job</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print alphabetical-column" id="position">Position</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print alphabetical-column" id="team-manager">Team Manager</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print alphabetical-column" id="team-leader">Team Leader</button>
        <hr class="border-info prevent-print"/>

        @if($employees)
            <table class="table table-sm table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">ID</th>
                        <th scope="col" class="ssn d-none">SSN</th>
                        <th scope="col" class="hire-date d-none">Hire Date</th>
                        <th scope="col" class="birth-date d-none">Birth Date</th>
                        <th scope="col" class="service-date d-none">Service Date</th>
                        <th scope="col" class="address d-none">Address</th>
                        <th scope="col" class="bid-eligible d-none">Bid Eligible</th>
                        <th scope="col" class="vitality d-none">Vitality</th>
                        <th scope="col" class="cost-center d-none">Cost Center</th>
                        <th scope="col" class="shift d-none">Shift</th>
                        <th scope="col" class="job d-none">Job</th>
                        <th scope="col" class="position d-none">Position</th>
                        <th scope="col" class="team-manager d-none">Team Manager</th>
                        <th scope="col" class="team-leader d-none">Team Leader</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                    <tr class="clickable-row" data-href="{{ url('hr.employees/'.$employee->id) }}">
                        <td>{{$employee->first_name}} {{$employee->last_name}}</td>
                        <td>{{$employee->id}}</td>
                        <td class="ssn d-none">{{$employee->ssn}}</td>
                        <td class="hire-date d-none">{{$employee->hire_date->format('m-d-Y')}}</td>
                        <td class="birth-date d-none">{{$employee->birth_date->format('m-d-Y')}}</td>
                        <td class="service-date d-none">{{$employee->service_date->format('m-d-Y')}}</td>
                        <td class="address d-none">{{$employee->address_1}} {{$employee->address_2}}, {{$employee->city}}, {{$employee->state}}, {{$employee->zip_code}}</td>
                        <td class="bid-eligible d-none">{{$employee->bid_eligible == '0' ? 'No' : 'Yes'}}</td>
                        <td class="vitality d-none">{{$employee->vitality_incentive == '1' ? 'Yes' : 'No'}}</td>
                        @foreach($employee->costCenter as $costCenter)
                        <td class="cost-center d-none">{{$costCenter->number}}</td>
                        @endforeach
                        @foreach($employee->shift as $shift)
                        <td class="shift d-none">{{$shift->description}}</td>
                        @endforeach
                        @foreach($employee->job as $job)
                        <td class="job d-none">{{$job->description}}</td>
                        @endforeach
                        @foreach($employee->position as $position)
                        <td class="position d-none">{{$position->description}}</td>
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