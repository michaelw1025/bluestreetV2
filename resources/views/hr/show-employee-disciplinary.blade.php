@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Disciplinary<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')

        @if($disciplinary)
        <nav class="nav">
        <a class="nav-link h3 text-primary" href="{{url('hr.employees/'.$disciplinary->employee->id)}}">{{$disciplinary->employee->first_name}} {{$disciplinary->employee->last_name}}</a>
        </nav>

        <!-- <form> -->
        <form method="post" action="{{route('hr.employee-disciplinary-update')}}">
        {{ csrf_field() }}


        <div class="form-row align-items-center employee-disciplinary ">

        <!-- <div class="col-xl-4 my-1">
            <label class="sr-only" for="disciplinary_update">Add Disciplinary</label>
            <div class="input-group border border-secondary">
                <div class="input-group-prepend">
                    <div class="input-group-text">Add Disciplinary</div>
                </div>
                <div class="form-check form-check-inline ml-4">
                    <input class="form-check-input" type="checkbox" name="disciplinary_update" value="1" checked>
                    <label class="form-check-label">Check to Add This Disciplinary</label>
                </div>
            </div>
        </div> -->

        <div class="col-xl-4 my-1">
            <label class="sr-only" for="disciplinary_type">Disciplinary Type</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Disciplinary Type</div>
                </div>
                <select class="form-control" name="disciplinary_type">
                    <option></option>
                    <option {{ $disciplinary->type == 'attendance' ? 'selected' : '' }} value="attendance">Attendance</option>
                    <option {{ $disciplinary->type == 'performance' ? 'selected' : '' }} value="performance">Performance</option>
                </select>
            </div>
            <small class="text-danger">{{ $errors->first('disciplinary_type') }}</small>
        </div>

        <div class="col-xl-4 my-1">
            <label class="sr-only" for="disciplinary_level">Disciplinary Level</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Disciplinary Level</div>
                </div>
                <select class="form-control" name="disciplinary_level">
                    <option></option>
                    <option {{ $disciplinary->level == 'first' ? 'selected' : '' }} value="first">First</option>
                    <option {{ $disciplinary->level == 'second' ? 'selected' : '' }} value="second">Second</option>
                    <option {{ $disciplinary->level == 'final' ? 'selected' : '' }} value="final">Final</option>
                    <option {{ $disciplinary->level == 'hr review' ? 'selected' : '' }} value="hr review">HR Review</option>
                    <option {{ $disciplinary->level == '2nd hr review' ? 'selected' : '' }} value="2nd hr review">2nd HR Review</option>
                    <option {{ $disciplinary->level == 'discussion' ? 'selected' : '' }} value="discussion">Discussion</option>
                </select>
            </div>
            <small class="text-danger">{{ $errors->first('disciplinary_level') }}</small>
        </div>

        <div class="col-xl-4 my-1">
            <label class="sr-only" for="disciplinary_date">Disciplinary Date</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Disciplinary Date</div>
                </div>
                <input type="text" class="form-control ui-datepicker-prev date-pick" name="disciplinary_date" value="{{ $disciplinary->date->format('m-d-Y') }}">
            </div>
            <small class="text-danger">{{ $errors->first('disciplinary_date') }}</small>
        </div>

        @if(isset($costCenters))
        <div class="col-xl-4 my-1">
            <label class="sr-only" for="disciplinary_cost_center">Cost Center</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Cost Center</div>
                </div>
                <select class="form-control" name="disciplinary_cost_center">
                    <option></option>
                    @foreach($costCenters as $costCenter)
                    <option {{ $disciplinary->cost_center == $costCenter->id ? 'selected' : '' }} value="{{$costCenter->id}}">{{$costCenter->number}} - {{$costCenter->description}}</option>
                    @endforeach
                </select>
            </div>
            <small class="text-danger">{{ $errors->first('disciplinary_cost_center') }}</small>
        </div>
        @endif

        @if(isset($salaryPositions))
        <div class="col-xl-4 my-1">
            <label class="sr-only" for="disciplinary_issued_by">Issued By</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Issued By</div>
                </div>
                <select class="form-control" name="disciplinary_issued_by">
                    <option></option>
                    @foreach($salaryPositions as $salaryPosition)
                    @foreach($salaryPosition->employee as $salaryEmployee)
                    <option {{$disciplinary->issued_by == $salaryEmployee->pivot->employee_id ? 'selected' : ''}} value="{{$salaryEmployee->pivot->employee_id}}">{{$salaryEmployee->first_name}} {{$salaryEmployee->last_name}}</option>
                    @endforeach
                    @endforeach
                </select>
            </div>
            <small class="text-danger">{{ $errors->first('disciplinary_issued_by') }}</small>
        </div>
        @endif

        <div class="input-group my-1 ml-1 mr-1">
            <div class="input-group-prepend">
                <span class="input-group-text">Disciplinary Comments</span>
            </div>
            <textarea class="form-control" name="disciplinary_comments">{{ $disciplinary->comments }}</textarea>
        </div>

        </div> <!-- end form row -->

        <div class="form-group row prevent-print mt-4">
            <div class="col-sm-10 col-md-8 col-lg-6">
                <input type="text" class="d-none" value="{{$disciplinary->id}}" name="disciplinary_id">
                <input type="text" class="d-none" value="{{$disciplinary->employee->id}}" name="employee_id">
                <button type="submit" class="btn btn-warning update-disciplinary" name="update_disciplinary" value="update">Edit Disciplinary</button>
                <button type="submit" class="btn btn-danger delete-disciplinary" name="delete_disciplinary" value="delete">Delete Disciplinary</button>
            </div>
        </div>



            
        </form>
            <!-- </form> -->

        @endif

    </div>
</div>
@endsection