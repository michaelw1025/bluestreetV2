@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Contractor Employee<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')

        <h3 class="prevent-print">Edit Contractor Employee</h3>
        <!-- <form> -->
        <form method="post" action="" class="">
        {{ csrf_field() }}
        <div class="form-row align-items-center">

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="contractor_employee_contractors">Contractor</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger ">*</span>&nbsp;Contractor</div>
                    </div>
                    <select class="form-control" name="contractor_employee_contractors" required>
                        <option></option>
                        @isset($contractors)
                            @foreach($contractors as $contractor)
                            <option {{ isset($contractorEmployee) ? ($contractorEmployee->contractor->id == $contractor->id ? 'selected' : '') : (old('contractor_employee_contractors') == $contractor->id ? 'selected' : '') }} value="{{$contractor->id}}">{{$contractor->contractor_name}}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('contractor_employee_contractors') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="contractor_employee_first_name">First Name</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger ">*</span>&nbsp;First Name</div>
                    </div>
                    <input type="text" class="form-control" name="contractor_employee_first_name" value="{{ isset($contractorEmployee) ? $contractorEmployee->contractor_employee_first_name : old('contractor_employee_first_name') }}">
                </div>
                <small class="text-danger">{{ $errors->first('contractor_employee_first_name') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="contractor_employee_last_name">Last Name</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger ">*</span>&nbsp;Last Name</div>
                    </div>
                    <input type="text" class="form-control" name="contractor_employee_last_name" value="{{ isset($contractorEmployee) ? $contractorEmployee->contractor_employee_last_name : old('contractor_employee_last_name') }}">
                </div>
                <small class="text-danger">{{ $errors->first('contractor_employee_last_name') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="contractor_employee_training_completion_date">Training Completion Date</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Training Completion Date</div>
                    </div>
                    <input type="text" class="form-control ui-datepicker-prev date-pick" name="contractor_employee_training_completion_date" value="{{ isset($contractorEmployee) ? $contractorEmployee->training_completion_date->format('m-d-Y') : old('contractor_employee_training_completion_date') }}">
                </div>
                <small class="text-danger">{{ $errors->first('contractor_employee_training_completion_date') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="contractor_employee_re_training_due_date">Training Due Date</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Training Due Date</div>
                    </div>
                    <input type="text" class="form-control ui-datepicker-prev date-pick" name="contractor_employee_re_training_due_date" value="{{ isset($contractorEmployee) ? $contractorEmployee->re_training_due_date->format('m-d-Y') : old('contractor_employee_re_training_due_date') }}">
                </div>
                <small class="text-danger">{{ $errors->first('contractor_employee_re_training_due_date') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="contractor_employee_status">Status</label>
                <div class="input-group border border-dark">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger ">*</span>&nbsp;Status</div>
                    </div>
                    <div class="form-check form-check-inline ml-4">
                        <input class="form-check-input" type="radio" name="contractor_employee_status" value="1" {{isset($contractorEmployee) ? ($contractorEmployee->active == '1' ? 'checked' : '') : ''}}>
                        <label class="form-check-label">Active</label>
                    </div>
                    <div class="form-check form-check-inline ml-4">
                        <input class="form-check-input" type="radio" name="contractor_employee_status" value="0" {{isset($contractorEmployee) ? ($contractorEmployee->active == '0' ? 'checked' : '') : ''}}>
                        <label class="form-check-label">Inactive</label>
                    </div>
                </div>
                <small class="text-danger">{{ $errors->first('contractor_employee_status') }}</small>
            </div>
            
            
        </div>
        @if(Auth::user()->navigationRoles(['admin', 'hrmanager', 'hruser']))
        <div class="form-group form-row prevent-print">
            <div class="col-sm-10 col-md-8 col-lg-6 mt-1">
                <button type="submit" class="btn btn-warning" formaction="{{url('hr.contractor-employee/'.$contractorEmployee['id'].'/update')}}">Edit Contractor Employee</button>
                <button type="submit" class="btn btn-danger delete-item" formaction="{{url('hr.contractor-employee/'.$contractorEmployee['id'].'/delete')}}" name="employee">Delete Contractor Employee</button>
            </div>
        </div>
        @endif
        </form>
        <!-- </form> -->
    </div>
</div>
@endsection