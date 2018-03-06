@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Employee<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')

        @if($employee)

        <!-- <form> -->
        <form method="post" action="">
        {{ csrf_field() }}
            <div class="form-group row">
                <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="first_name" required value="{{$employee['first_name']}}">
                    <small class="text-danger">{{ $errors->first('first_name') }}</small>
                </div>
            </div>
            <div class="form-group row">
                <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="last_name" required value="{{$employee['last_name']}}">
                    <small class="text-danger">{{ $errors->first('last_name') }}</small>
                </div>
            </div>
            <div class="form-group row">
                <label for="middle_initial" class="col-sm-2 col-form-label">Middle Initial</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="middle_initial" required value="{{$employee['middle_initial']}}">
                    <small class="text-danger">{{ $errors->first('middle_initial') }}</small>
                </div>
            </div>
            <div class="form-group row">
                <label for="ssn" class="col-sm-2 col-form-label">SSN</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control ssn-format" name="ssn" required value="{{$employee['ssn']}}" maxlength="11">
                    <small class="text-danger">{{ $errors->first('ssn') }}</small>
                </div>
            </div>

            <div class="form-group row prevent-print">
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <button type="submit" class="btn btn-warning update-employee" formaction="{{url('hr.employees/'.$employee['id'].'/update')}}">Edit Employee</button>
                    <button type="submit" class="btn btn-danger delete-item" formaction="{{url('hr.employees/'.$employee['id'].'/delete')}}" name="employee">Delete Employee</button>
                </div>
            </div>
        </form>
            <!-- </form> -->

            @endif

    </div>
</div>
@endsection