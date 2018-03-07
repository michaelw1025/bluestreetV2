@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Employees<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')

        <h3 class="prevent-print">Search Employee</h3>
        <!-- <form> -->
        <form method="get" action="" class="prevent-print">
        {{ csrf_field() }}
            <div class="form-group row">
                <label for="search_last_name" class="col-sm-2 col-form-label">Last Name</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="search_last_name" value="">
                </div>
            </div>
            <div class="form-group row">
                <label for="search_ssn" class="col-sm-2 col-form-label">SSN</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control ssn-format" name="search_ssn" maxlength="11">
                </div>
            </div>
            <div class="form-group row">
                <label for="search_birth_date" class="col-sm-2 col-form-label">Date of Birth</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control ui-datepicker-prev date-pick" name="search_birth_date">
                </div>
            </div>
            <div class="form-group row">
                <label for="search_hire_date" class="col-sm-2 col-form-label">Date of Hire</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control ui-datepicker-prev date-pick" name="search_hire_date">
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-sm-10 col-md-8 col-lg-6">
                @if($routeName == 'hr.all-employees/inactive' || $routeName == 'hr.search-employees/inactive')
                    <button type="submit" class="btn btn-success update-employee" formaction="{{url('hr.search-employees/inactive')}}">Search Employees</button>
                @else
                    <button type="submit" class="btn btn-success update-employee" formaction="{{url('hr.search-employees/active')}}">Search Employees</button>
                @endif
                </div>
            </div>
        </form>
        <!-- </form> -->
        <hr class="border-info mt-4 mb-4 prevent-print"/>

        @if($employees)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">MI</th>
                        <th scope="col">SSN</th>
                        <th scope="col">Birth Date</th>
                        <th scope="col">Hire Date</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                    <tr class="clickable-row" data-href="{{ url('hr.employees/'.$employee->id) }}">
                    <td>{{$employee->id}}</td>
                        <td>{{$employee->first_name}}</td>
                        <td>{{$employee->last_name}}</td>
                        <td>{{$employee->middle_initial}}</td>
                        <td>{{$employee->ssn}}</td>
                        <td>{{$employee->birth_date->format('m-d-Y')}}</td>
                        <td>{{$employee->hire_date->format('m-d-Y')}}</td>
                    </tr>
                @endforeach
                <tbody>
            </table>
        @endif
    </div>
</div>
@endsection