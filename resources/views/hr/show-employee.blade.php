@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Employee<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')

        <ul class="list-group col-xl-6">
        @if($staffManager->employeeStaffManager->isNotEmpty())
            <li class="list-group-item list-group-item-primary h5"><span class="text-Primary">Staff Manager:</span>&nbsp&nbsp  {{$staffManager->employeeStaffManager[0]->first_name}} {{$staffManager->employeeStaffManager[0]->last_name}}</li>
        @endif
        @if(!is_null($employee->teamManager))
            <li class="list-group-item list-group-item-info h5"><span class="text-Primary">Team Manager:</span>&nbsp&nbsp  {{$employee->teamManager}}</li>
        @endif
        @if(!is_null($employee->teamLeader))
            <li class="list-group-item list-group-item-secondary h5"><span class="text-Primary">Team Leader:</span>&nbsp&nbsp  {{$employee->teamLeader}}</li>
        @endif
        </ul>
        <hr class="border-info"/>


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

            <!-- Include health insurance form -->
            @include('hr.forms.employee-health-insurance-form')

            <!-- Include medical insurance form -->
            @include('hr.forms.employee-medical-insurance-form')

            <!-- Include dental insurance form -->
            @include('hr.forms.employee-dental-insurance-form')

            <!-- Include vision insurance form -->
            @include('hr.forms.employee-vision-insurance-form')

            <!-- Include life insurance form -->
            @include('hr.forms.employee-life-insurance-form')

            <!-- Include parking permit form -->
            @include('hr.forms.employee-parking-permit-form')

            <!-- Include disciplinary form -->
            @include('hr.forms.employee-disciplinary-form')

            <!-- Include termination form -->
            @include('hr.forms.employee-termination-form')

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