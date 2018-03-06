@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Jobs<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')

        <h3 class="prevent-print">Add Job</h3>
        <!-- <form> -->
        <form method="post" action="" class="prevent-print">
        {{ csrf_field() }}
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Job Description</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="description" required value="{{old('description')}}">
                    <small class="text-danger">{{ $errors->first('description') }}</small>
                </div>
            </div>
            @if($positions)
                <div class="form-group row">
                    <label for="position" class="col-sm-2 col-form-label">Job Position</label>
                    <div class="col-sm-10 col-md-8 col-lg-6">
                        <select class="form-control" name="position" required >
                            @foreach($positions as $position)
                            <option value="{{$position->id}}">{{$position->description}}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">{{ $errors->first('position') }}</small>
                    </div>
                </div>
            @endif
            @if($wageTitles)
                <div class="form-group row">
                    <label for="wage_title" class="col-sm-2 col-form-label">Job Wage Title</label>
                    <div class="col-sm-10 col-md-8 col-lg-6">
                        <select class="form-control" name="wage_title" required >
                            @foreach($wageTitles as $wageTitle)
                            <option value="{{$wageTitle->id}}">{{$wageTitle->description}}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">{{ $errors->first('wage_title') }}</small>
                    </div>
                </div>
            @endif
            
            <div class="form-group row">
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <button type="submit" class="btn btn-success" formaction="{{url('hr.jobs')}}">Create Job</button>
                </div>
            </div>
        </form>
        <!-- </form> -->
        <hr class="border-info mt-4 mb-4 prevent-print"/>

        @if($jobs)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Description</th>
                        <th scope="col">Position</th>
                        <th scope="col">Wage Title</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($jobs as $job)
                    <tr class="clickable-row" data-href="{{ url('hr.jobs/'.$job->id) }}">
                        <td>{{$job->description}}</td>
                        @foreach($job->position as $position)
                        <td>{{$position->description}}</td>
                        @endforeach
                        @foreach($job->wageTitle as $wageTitle)
                        <td>{{$wageTitle->description}}</td>
                        @endforeach
                    </tr>
                @endforeach
                <tbody>
            </table>
        @endif
    </div>
</div>
@endsection