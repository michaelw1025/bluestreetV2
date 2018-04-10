@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Contractors<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')

        <h3 class="prevent-print">Add Contractor</h3>
        <!-- <form> -->
        <form method="post" action="" class="prevent-print">
        {{ csrf_field() }}
        <div class="form-row align-items-center">
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="contractor_name">Contractor Name</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Contractor Name</div>
                    </div>
                    <input type="text" class="form-control" name="contractor_name" required value="{{ old('contractor_name') }}">
                </div>
                <small class="text-danger">{{ $errors->first('contractor_name') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="contact_first_name">Contact First Name</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Contact First Name</div>
                    </div>
                    <input type="text" class="form-control" name="contact_first_name" value="{{ old('contact_first_name') }}">
                </div>
                <small class="text-danger">{{ $errors->first('contact_first_name') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="contact_last_name">Contact Last Name</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Contact Last Name</div>
                    </div>
                    <input type="text" class="form-control" name="contact_last_name" value="{{ old('contact_last_name') }}">
                </div>
                <small class="text-danger">{{ $errors->first('contact_last_name') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="contact_email">Contact Email</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Contact Email</div>
                    </div>
                    <input type="text" class="form-control" name="contact_email" value="{{ old('contact_email') }}">
                </div>
                <small class="text-danger">{{ $errors->first('contact_email') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="contact_phone_number">Contractor Phone Number</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Contractor Phone Number</div>
                    </div>
                    <input type="text" class="form-control" name="contact_phone_number" value="{{ old('contact_phone_number') }}">
                </div>
                <small class="text-danger">{{ $errors->first('contact_phone_number') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="general_liability_insurance_date">General Liability Ins</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">General Liability Ins</div>
                    </div>
                    <input type="text" class="form-control ui-datepicker-prev date-pick" name="general_liability_insurance_date" value="{{ old('general_liability_insurance_date') }}">
                </div>
                <small class="text-danger">{{ $errors->first('general_liability_insurance_date') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="work_comp_employment_insurance_date">Work Comp Ins</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Work Comp Ins</div>
                    </div>
                    <input type="text" class="form-control ui-datepicker-prev date-pick" name="work_comp_employment_insurance_date" value="{{ old('work_comp_employment_insurance_date') }}">
                </div>
                <small class="text-danger">{{ $errors->first('work_comp_employment_insurance_date') }}</small>
            </div>
            
            
        </div>
            <div class="form-group row">
                <div class="col-sm-10 col-md-8 col-lg-6 mt-1">
                    <button type="submit" class="btn btn-success" formaction="{{url('hr.store-contractor')}}">Create Contractor</button>
                </div>
            </div>
        </form>
        <!-- </form> -->
        <hr class="border-info mt-4 mb-4 prevent-print"/>

        @if(isset($contractors))
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Contact Email</th>
                        <th scope="col">Contact Phone</th>
                        <th scope="col">GL Ins</th>
                        <th scope="col">WC Ins</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($contractors as $contractor)
                    <tr class="clickable-row" data-href="{{ url('hr.show-contractor/'.$contractor->id) }}">
                        <td>{{$contractor->contractor_name}}</td>
                        <td>{{$contractor->contact_first_name}} {{$contractor->contact_last_name}}</td>
                        <td>{{$contractor->contact_email}}</td>
                        <td>{{$contractor->contact_phone_number}}</td>
                        <td>{{$contractor->general_liability_insurance_date->format('m-d-Y')}}</td>
                        <td>{{$contractor->work_comp_employment_insurance_date->format('m-d-Y')}}</td>
                    </tr>
                @endforeach
                <tbody>
            </table>
        @endif
    </div>
</div>
@endsection