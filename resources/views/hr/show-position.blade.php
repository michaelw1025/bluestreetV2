@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Position<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')

        @if($position)

        <!-- <form> -->
        <form method="post" action="">
        {{ csrf_field() }}
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Position Description</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="description" required value="{{$position->description}}">
                    <small class="text-danger">{{ $errors->first('description') }}</small>
                </div>
            </div>

            @if($jobs)
                <div class="form-group row">
                    <label for="job" class="col-sm-2 col-form-label">Position Job</label>
                    <div class="col-sm-10 col-md-8 col-lg-6">
                        <select class="form-control" name="job" required >
                        <option></option>
                            @foreach($jobs as $job)
                            <option @foreach($position->job as $positionJob) {{$positionJob->id == $job->id ? 'selected' : ''}} @endforeach value="{{$job->id}}">{{$job->description}}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">{{ $errors->first('job') }}</small>
                    </div>
                </div>
            @endif

            @if($wageTitles)
                <div class="form-group row">
                    <label for="wage_title" class="col-sm-2 col-form-label">Position wage Title</label>
                    <div class="col-sm-10 col-md-8 col-lg-6">
                        <select class="form-control" name="wage_title" required >
                        <option></option>
                            @foreach($wageTitles as $wageTitle)
                            <option @foreach($position->wageTitle as $positionWageTitle) {{$positionWageTitle->id == $wageTitle->id ? 'selected' : ''}} @endforeach value="{{$wageTitle->id}}">{{$wageTitle->description}}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">{{ $errors->first('wage_title') }}</small>
                    </div>
                </div>
            @endif

            <div class="form-group row prevent-print">
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <button type="submit" class="btn btn-warning" formaction="{{url('hr.positions/'.$position->id.'/update')}}">Edit Position</button>
                    <!-- <button type="submit" class="btn btn-danger delete-item" formaction="{{url('hr.positions/'.$position->id.'/delete')}}" name="position">Delete Position</button> -->
                </div>
            </div>
        </form>
            <!-- </form> -->

            @endif

    </div>
</div>
@endsection