@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Employee Reviews<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print review-column" id="thirty-day">30 Day</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print review-column" id="sixty-day">60 Day</button>
        <hr class="border-info prevent-print"/>

        @if($employees)
            <table class="table table-sm table-bordered mt-4">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">ID</th>
                        <th scope="col" class="hire-date">Hire Date</th>
                        <th scope="col" class="cost-center">Cost Center</th>
                        <th scope="col" class="shift">Shift</th>
                        <th scope="col" class="team-manager">Team Manager</th>
                        <th scope="col" class="team-leader">Team Leader</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                    <tr class="clickable-row {{ $employee->thirty_day_review != '1' ? 'thirty-day' : '' }}  {{ $employee->sixty_day_review != '1' ? 'sixty-day' : '' }} d-none" data-href="{{ url('hr.employees/'.$employee->id) }}">
                        <td>{{$employee->first_name}} {{$employee->last_name}}</td>
                        <td>{{$employee->id}}</td>
                        <td class="hire-date">{{$employee->hire_date->format('m-d-Y')}}</td>
                        @foreach($employee->costCenter as $costCenter)
                        <td class="cost-center">{{$costCenter->number}}</td>
                        @endforeach
                        @foreach($employee->shift as $shift)
                        <td class="shift">{{$shift->description}}</td>
                        @endforeach
                        <td class="team-manager">{{$employee->team_manager}}</td>
                        <td class="team-leader">{{$employee->team_leader}}</td>
                    </tr>
                @endforeach
                <tbody>
            </table>
        @endif
    </div>
</div>
@endsection