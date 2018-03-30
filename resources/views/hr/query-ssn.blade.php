@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Find SSN<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')
        <form method="get" action="{{url('hr.query-ssn')}}">
        {{ csrf_field() }}
        <div class="form-row align-items-center">
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="ssn">SSN</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">SSN</div>
                    </div>
                    <input type="text" class="form-control ssn-format" name="ssn" required maxlength="11" value="{{ isset($searchSSN) ? $searchSSN : old('ssn') }}">
                </div>
                <small class="text-danger">{{ $errors->first('ssn') }}</small>
            </div>
            <button type="submit" class="btn btn-outline-success prevent-print update-employee" name="submit_ssn_search" value="search">Search</button>
        </div>
        </form>

        <hr class="border-info prevent-print"/>

        @if(isset($employee))
            <table class="table table-sm table-striped table-bordered table-hover mt-4">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Birth Date</th>
                        <th scope="col">Hire Date</th>
                    </tr>
                </thead>
                <tbody>

 
                    <tr class="clickable-row" data-href="{{ url('hr.employees/'.$employee->id) }}">
                        <td>{{$employee->first_name}} {{$employee->last_name}}</td>
                        <td>{{$employee->birth_date->format('m-d-Y')}}</td>
                        <td>{{$employee->hire_date->format('m-d-Y')}}</td>
                    </tr>


                <tbody>
            </table>
        @endif
    </div>
</div>
@endsection