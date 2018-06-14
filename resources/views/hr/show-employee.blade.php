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
        @if(!is_null($employee->team_manager))
            <li class="list-group-item list-group-item-info h5"><span class="text-Primary">Team Manager:</span>&nbsp&nbsp  {{$employee->team_manager}}</li>
        @endif
        @if(!is_null($employee->team_leader))
            <li class="list-group-item list-group-item-secondary h5"><span class="text-Primary">Team Leader:</span>&nbsp&nbsp  {{$employee->team_leader}}</li>
        @endif
        </ul>
        <hr class="border-info"/>

        <p class="text-danger prevent-print">* indicates a required field</p>

        <form method="post" action="" enctype="multipart/form-data">
            {{ csrf_field() }}


            @if(is_null($employee->photo_link))
            <div class="form-group prevent-print">
                <div class="input-group input-file" name="file">
                    <span class="input-group-btn">
                        <button class="btn btn-default btn-choose" type="button">Choose</button>
                    </span>
                    <input type="text" class="form-control" placeholder='Choose a file...' />
                    <span class="input-group-btn">
                        <button class="btn btn-warning btn-reset" type="button">Reset</button>
                    </span>
                </div>
            </div>
            @else
            <figure class="figure">
                <img src="{{$employee->link}}" class="img-thumbnail" width="200" height="200">
                <figcaption class="figure-caption text-right prevent-print"><a href="{{ url('hr.employee-photo-destroy/'.$employee->id) }}" class="text-info">Delete</a></figcaption>
            </figure>
            @endif


            <!-- Include employee demographic form -->
            @include('hr.forms.employee-demographic-form')

            <!-- Include position form -->
            @include('hr.forms.employee-position-form')

            <!-- Include wage form -->
            @include('hr.forms.employee-wage-form')

            <!-- Include wage event form -->
            @include('hr.forms.employee-wage-event-form')

            <!-- Include employee spouse form -->
            @include('hr.forms.employee-spouse-form')

            <!-- Include employee dependant form -->
            @include('hr.forms.employee-dependant-form')

            <!-- Include employee phone number form -->
            @include('hr.forms.employee-phone-number-form')

            <!-- Include employee emergency contact form -->
            @include('hr.forms.employee-emergency-contact-form')

            <!-- Include vision voucher form -->
            @include('hr.forms.employee-vision-voucher-form')

            <!-- Include parking permit form -->
            @include('hr.forms.employee-parking-permit-form')

            <!-- Include disciplinary form -->
            @include('hr.forms.employee-disciplinary-form')

            <!-- Include termination form -->
            @include('hr.forms.employee-termination-form')

            <!-- Include reduction form -->
            @include('hr.forms.employee-reduction-form')

            <!-- Include employee bidding form -->
            @include('hr.forms.employee-bidding-form')

        <div class="form-group row prevent-print mt-4">
            <div class="col-sm-10 col-md-8 col-lg-6">
                <input type="text" class="d-none" name="update_employee" value="update">
                <button type="submit" class="btn btn-warning update-employee" formaction="{{url('hr.employees/'.$employee['id'].'/update')}}">Edit Employee</button>
                <!-- <button type="submit" class="btn btn-danger delete-employee" formaction="{{url('hr.employees/'.$employee['id'].'/delete')}}" name="employee">Set As Inactive</button> -->
            </div>
        </div>

        </form>
        <!-- </form> -->

    </div>
</div>
@endsection
