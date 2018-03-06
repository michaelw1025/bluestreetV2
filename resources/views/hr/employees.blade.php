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
        <!-- <form method="post" action="" class="prevent-print">
        {{ csrf_field() }}
            <div class="form-group row">
                <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="first_name" required value="{{old('first_name')}}">
                    <small class="text-danger">{{ $errors->first('first_name') }}</small>
                </div>
            </div>
            <div class="form-group row">
                <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="last_name" required value="{{old('last_name')}}">
                    <small class="text-danger">{{ $errors->first('last_name') }}</small>
                </div>
            </div>
            <div class="form-group row">
                <label for="middle_initial" class="col-sm-2 col-form-label">Middle Initial</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="middle_initial" required value="{{old('middle_initial')}}">
                    <small class="text-danger">{{ $errors->first('middle_initial') }}</small>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <button type="submit" class="btn btn-success" formaction="{{url('hr.employees')}}">Create Employee</button>
                </div>
            </div>
        </form> -->
        <!-- </form> -->
        <hr class="border-info mt-4 mb-4 prevent-print"/>

        @if($employees)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">MI</th>
                        <th scope="col">SSN</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                    <tr class="clickable-row" data-href="{{ url('hr.employees/'.$employee->id) }}">
                        <td>{{$employee->first_name}}</td>
                        <td>{{$employee->last_name}}</td>
                        <td>{{$employee->middle_initial}}</td>
                        <td>{{$employee->ssn}}</td>
                    </tr>
                @endforeach
                <tbody>
            </table>
        @endif
    </div>
</div>
@endsection