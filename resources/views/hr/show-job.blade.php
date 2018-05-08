@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Job<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')

        @if($job)

        <!-- <form> -->
        <form method="post" action="">
        {{ csrf_field() }}
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Job Description</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="description" required value="{{$job->description}}">
                    <small class="text-danger">{{ $errors->first('description') }}</small>
                </div>
            </div>

            @if($positions)
                <div class="form-group row">
                    <label for="position" class="col-sm-2 col-form-label">Job Position</label>
                    <div class="col-sm-10 col-md-8 col-lg-6">
                        <select class="form-control" name="position" required >
                        <option></option>
                            @foreach($positions as $position)
                            <option @foreach($job->position as $jobPosition) {{$jobPosition->id == $position->id ? 'selected' : ''}} @endforeach value="{{$position->id}}">{{$position->description}}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">{{ $errors->first('position') }}</small>
                    </div>
                </div>
            @endif

            @if($wageTitles)
                <div class="form-group row">
                    <label for="wage_title" class="col-sm-2 col-form-label">Job wage Title</label>
                    <div class="col-sm-10 col-md-8 col-lg-6">
                        <select class="form-control" name="wage_title" required >
                        <option></option>
                            @foreach($wageTitles as $wageTitle)
                            <option @foreach($job->wageTitle as $jobWageTitle) {{$jobWageTitle->id == $wageTitle->id ? 'selected' : ''}} @endforeach value="{{$wageTitle->id}}">{{$wageTitle->description}}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">{{ $errors->first('wage_title') }}</small>
                    </div>
                </div>
            @endif

            <div class="form-group row">
                    <div class="col-sm-10 col-md-8 col-lg-6">
                    @foreach($job->position as $jobPosition)
                        <p>{{$jobPosition->description}}</p>
                        @endforeach
                    </div>
                </div>

            <div class="form-group row prevent-print">
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <button type="submit" class="btn btn-warning" formaction="{{url('hr.jobs/'.$job->id.'/update')}}">Edit Job</button>
                    <!-- <button type="submit" class="btn btn-danger delete-item" formaction="{{url('hr.jobs/'.$job->id.'/delete')}}" name="job">Delete Job</button> -->
                </div>
            </div>
        </form>
            <!-- </form> -->

            @endif

    </div>
</div>
@endsection