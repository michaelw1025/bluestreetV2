@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Termination<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')

        @if($termination)
        <nav class="nav">
        <a class="nav-link h3 text-primary" href="{{url('hr.employees/'.$termination->employee->id)}}">{{$termination->employee->first_name}} {{$termination->employee->last_name}}</a>
        </nav>

        <!-- <form> -->
        <form method="post" action="{{route('hr.employee-termination-update')}}">
        {{ csrf_field() }}


        <div class="form-row align-items-center employee-termination ">

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
            <label class="sr-only" for="termination_type">Termination Type</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Termination Type</div>
                </div>
                <select class="form-control" name="termination_type">
                    <option></option>
                    <option {{ $termination->type == 'voluntary' ? 'selected' : '' }} value="voluntary">Voluntary</option>
                    <option {{ $termination->type == 'involuntary' ? 'selected' : '' }} value="involuntary">Involuntary</option>
                </select>
            </div>
            <small class="text-danger">{{ $errors->first('termination_type') }}</small>
        </div>

        <div class="col-xl-4 my-1">
            <label class="sr-only" for="termination_date">Termination Date</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Termination Date</div>
                </div>
                <input type="text" class="form-control ui-datepicker-prev date-pick" name="termination_date" value="{{ $termination->date->format('m-d-Y') }}">
            </div>
            <small class="text-danger">{{ $errors->first('termination_date') }}</small>
        </div>

        <div class="col-xl-4 my-1">
            <label class="sr-only" for="termination_last_day">Last Day Worked</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Last Day Worked</div>
                </div>
                <input type="text" class="form-control ui-datepicker-prev date-pick" name="termination_last_day" value="{{ $termination->last_day->format('m-d-Y') }}">
            </div>
            <small class="text-danger">{{ $errors->first('termination_last_day') }}</small>
        </div>

        <div class="input-group my-1 ml-1 mr-1">
            <div class="input-group-prepend">
                <span class="input-group-text">Termination Comments</span>
            </div>
            <textarea class="form-control" name="termination_comments">{{ $termination->comments }}</textarea>
        </div>

        </div> <!-- end form row -->

        <div class="form-group row prevent-print mt-4">
            <div class="col-sm-10 col-md-8 col-lg-6">
                <input type="text" class="d-none" value="{{$termination->id}}" name="termination_id">
                <input type="text" class="d-none" value="{{$termination->employee->id}}" name="employee_id">
                <button type="submit" class="btn btn-warning update-termination" name="termination_update" value="update">Edit Termination</button>
                <button type="submit" class="btn btn-danger delete-termination delete-item" name="termination" value="delete">Delete Termination</button>
            </div>
        </div>



            
        </form>
            <!-- </form> -->

        @endif

    </div>
</div>
@endsection