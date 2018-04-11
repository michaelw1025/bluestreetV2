@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Contractor Employees<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')

        <h3 class="prevent-print">Add Contractor Employee</h3>
        <!-- <form> -->
        <form method="post" action="" class="prevent-print">
        {{ csrf_field() }}
        <div class="form-row align-items-center">

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="contractor_employee_contractors">Contractor</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Contractor</div>
                    </div>
                    <select class="form-control" name="contractor_employee_contractors" required>
                        <option></option>
                        @isset($contractors)
                            @foreach($contractors as $contractor)
                            <option {{ old('contractor_employee_contractors') == $contractor->id ? 'selected' : '' }} value="{{$contractor->id}}">{{$contractor->contractor_name}}</option>
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
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;First Name</div>
                    </div>
                    <input type="text" class="form-control" name="contractor_employee_first_name" value="{{ old('contractor_employee_first_name') }}">
                </div>
                <small class="text-danger">{{ $errors->first('contractor_employee_first_name') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="contractor_employee_last_name">Last Name</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Last Name</div>
                    </div>
                    <input type="text" class="form-control" name="contractor_employee_last_name" value="{{ old('contractor_employee_last_name') }}">
                </div>
                <small class="text-danger">{{ $errors->first('contractor_employee_last_name') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="contractor_employee_training_completion_date">Training Completion Date</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Training Completion Date</div>
                    </div>
                    <input type="text" class="form-control ui-datepicker-prev date-pick" name="contractor_employee_training_completion_date" value="{{ old('contractor_employee_training_completion_date') }}">
                </div>
                <small class="text-danger">{{ $errors->first('contractor_employee_training_completion_date') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="contractor_employee_re_training_due_date">Work Comp Ins</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Work Comp Ins</div>
                    </div>
                    <input type="text" class="form-control ui-datepicker-prev date-pick" name="contractor_employee_re_training_due_date" value="{{ old('contractor_employee_re_training_due_date') }}">
                </div>
                <small class="text-danger">{{ $errors->first('contractor_employee_re_training_due_date') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="contractor_employee_status">Status</label>
                <div class="input-group border border-dark">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Status</div>
                    </div>
                    <div class="form-check form-check-inline ml-4">
                        <input class="form-check-input" type="radio" name="contractor_employee_status" value="1">
                        <label class="form-check-label">Active</label>
                    </div>
                    <div class="form-check form-check-inline ml-4">
                        <input class="form-check-input" type="radio" name="contractor_employee_status" value="0">
                        <label class="form-check-label">Inactive</label>
                    </div>
                </div>
                <small class="text-danger">{{ $errors->first('contractor_employee_status') }}</small>
            </div>
            
            
        </div>
            <div class="form-group row">
                <div class="col-sm-10 col-md-8 col-lg-6 mt-1">
                    <button type="submit" class="btn btn-success" formaction="{{url('hr.store-contractor-employee')}}">Create Contractor Employee</button>
                </div>
            </div>
        </form>
        <!-- </form> -->
        <hr class="border-info mt-4 mb-4 prevent-print"/>

        @if(isset($contractors))
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Contractor</th>
                        <th scope="col">Employee Name</th>
                        <th scope="col">Training Completion</th>
                        <th scope="col">Training Due</th>
                        <th scope="col">Active</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($contractors as $contractor)
                    @foreach($contractor->contractorTraining as $contractorEmployee)
                    <tr class="clickable-row" data-href="{{ url('hr.show-contractor-employee/'.$contractorEmployee->id) }}">
                        <td>{{$contractor->contractor_name}}</td>
                        <td>{{$contractorEmployee->contractor_employee_first_name}} {{$contractorEmployee->contractor_employee_last_name}}</td>
                        <td>{{$contractorEmployee->training_completion_date->format('m-d-Y')}}</td>
                        <td>{{$contractorEmployee->re_training_due_date->format('m-d-Y')}}</td>
                        <td class="{{$contractorEmployee->active == 1 ? '' : 'text-danger'}}">{{$contractorEmployee->active == 1 ? 'Yes' : 'No'}}</td>
                    </tr>
                    @endforeach
                @endforeach
                <tbody>
            </table>
        @endif
    </div>
</div>
@endsection