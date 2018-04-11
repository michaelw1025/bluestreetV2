@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Contractor<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')

        <h3 class="prevent-print">Edit Contractor</h3>
        <!-- <form> -->
        <form method="post" action="" class="">
        {{ csrf_field() }}
        <div class="form-row align-items-center">
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="contractor_name">Contractor Name</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger ">*</span>&nbsp;Contractor Name</div>
                    </div>
                    <input type="text" class="form-control" name="contractor_name" required value="{{ isset($contractor) ? $contractor->contractor_name : old('contractor_name') }}">
                </div>
                <small class="text-danger">{{ $errors->first('contractor_name') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="contact_first_name">Contact First Name</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger ">*</span>&nbsp;Contact First Name</div>
                    </div>
                    <input type="text" class="form-control" name="contact_first_name" required value="{{ isset($contractor) ? $contractor->contact_first_name : old('contact_first_name') }}">
                </div>
                <small class="text-danger">{{ $errors->first('contact_first_name') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="contact_last_name">Contact Last Name</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger ">*</span>&nbsp;Contact Last Name</div>
                    </div>
                    <input type="text" class="form-control" name="contact_last_name" required value="{{ isset($contractor) ? $contractor->contact_last_name : old('contact_last_name') }}">
                </div>
                <small class="text-danger">{{ $errors->first('contact_last_name') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="contact_email">Contact Email</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger ">*</span>&nbsp;Contact Email</div>
                    </div>
                    <input type="text" class="form-control" name="contact_email" required value="{{ isset($contractor) ? $contractor->contact_email : old('contact_email') }}">
                </div>
                <small class="text-danger">{{ $errors->first('contact_email') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="contact_phone_number">Contractor Phone Number</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger ">*</span>&nbsp;Contractor Phone Number</div>
                    </div>
                    <input type="text" class="form-control" name="contact_phone_number" required value="{{ isset($contractor) ? $contractor->contact_phone_number : old('contact_phone_number') }}">
                </div>
                <small class="text-danger">{{ $errors->first('contact_phone_number') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="general_liability_insurance_date">General Liability Ins</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">General Liability Ins</div>
                    </div>
                    <input type="text" class="form-control ui-datepicker-prev date-pick" name="general_liability_insurance_date" value="{{ isset($contractor) ? $contractor->general_liability_insurance_date->format('m-d-Y') : old('general_liability_insurance_date') }}">
                </div>
                <small class="text-danger">{{ $errors->first('general_liability_insurance_date') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="work_comp_employment_insurance_date">Work Comp Ins</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Work Comp Ins</div>
                    </div>
                    <input type="text" class="form-control ui-datepicker-prev date-pick" name="work_comp_employment_insurance_date" value="{{ isset($contractor) ? $contractor->work_comp_employment_insurance_date->format('m-d-Y') : old('work_comp_employment_insurance_date') }}">
                </div>
                <small class="text-danger">{{ $errors->first('work_comp_employment_insurance_date') }}</small>
            </div>
            
            
        </div>
        <div class="form-group form-row prevent-print">
            <div class="col-sm-10 col-md-8 col-lg-6 mt-1">
                <button type="submit" class="btn btn-warning" formaction="{{url('hr.contractor/'.$contractor['id'].'/update')}}">Edit Contractor</button>
                <button type="submit" class="btn btn-danger delete-item" formaction="{{url('hr.contractor/'.$contractor['id'].'/delete')}}" name="contractor">Delete Contractor</button>
            </div>
        </div>
        </form>
        <!-- </form> -->        
        
    </div>


</div>

@endsection