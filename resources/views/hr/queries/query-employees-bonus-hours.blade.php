@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Alphabetical List Of Employees<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button><button type="button" class="mr-2 btn btn-success pl- pr-3 float-right btn-lg excel-export prevent-print" onclick="location.href='{{ url('hr.export-employees-bonus-hours') }}'">Export To Excel</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')

        <!-- <hr class="border-info prevent-print"/> -->

        @if(isset($employees))
            <table class="table table-sm table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">ID</th>
                        <th scope="col">Hire Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td colspan="3" class="text-center table-info">5-7 Years</td>
                    </tr>
                @foreach($employees as $employee)
                @if($employee->bonus_years == 5)
                    <tr class="clickable-row {{$employee->active_disciplinary == 1 ? 'table-danger' : ''}}" data-href="{{ url('hr.employees/'.$employee->id) }}">
                        <td>{{$employee->first_name}} {{$employee->last_name}}</td>
                        <td>{{$employee->id}}</td>
                        <td>{{$employee->hire_date->format('m-d-Y')}}</td>
                    </tr>
                @endif
                @endforeach
                    <tr class="">
                        <td colspan="3" class="text-center table-info">8+ Years</td>
                    </tr>
                @foreach($employees as $employee)
                @if($employee->bonus_years == 8)
                    <tr class="clickable-row {{$employee->active_disciplinary == 1 ? 'table-danger' : ''}}" data-href="{{ url('hr.employees/'.$employee->id) }}">
                        <td>{{$employee->first_name}} {{$employee->last_name}}</td>
                        <td>{{$employee->id}}</td>
                        <td>{{$employee->hire_date->format('m-d-Y')}}</td>
                    </tr>
                @endif
                @endforeach
                <tbody>
            </table>
        @endif
    </div>
</div>
@endsection