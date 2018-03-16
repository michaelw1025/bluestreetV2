@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Employee<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')

        <p class="text-danger prevent-print">* indicates a required field</p>

        <!-- <form> -->
        <form method="post" action="">
            {{ csrf_field() }}
            <!-- Include employee demographic form -->
            @include('hr.forms.employee-demographic-form')

            <!-- Include employee spouse form -->
            @include('hr.forms.employee-spouse-form')

            <!-- Include employee dependant form -->
            @include('hr.forms.employee-dependant-form')

            <!-- Include employee phone number form -->
            @include('hr.forms.employee-phone-number-form')

            <!-- Include employee emergency contact form -->
            @include('hr.forms.employee-emergency-contact-form')

            <!-- Include job contact form -->
            @include('hr.forms.employee-job-form')

            <!-- Include wage contact form -->
            @include('hr.forms.employee-wage-form')

            <!-- Include employee bidding form -->
            @include('hr.forms.employee-bidding-form')
            
        <div class="form-group row prevent-print mt-4">
            <div class="col-sm-10 col-md-8 col-lg-6">
                <input type="text" class="d-none" name="update_employee" value="update">
                <button type="submit" class="btn btn-warning update-employee" formaction="{{url('hr.employees/'.$employee['id'].'/update')}}">Edit Employee</button>
                <button type="submit" class="btn btn-danger delete-item" formaction="{{url('hr.employees/'.$employee['id'].'/delete')}}" name="employee">Delete Employee</button>
            </div>
        </div>

        </form>
        <!-- </form> -->

    </div>
</div>
@endsection