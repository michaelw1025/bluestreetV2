@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Positions<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')

        <h3 class="prevent-print">Add Position</h3>
        <!-- <form> -->
        <form method="post" action="" class="prevent-print">
        {{ csrf_field() }}
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Position Description</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="description" required value="{{old('description')}}">
                    <small class="text-danger">{{ $errors->first('description') }}</small>
                </div>
            </div>
            @if($jobs)
                <div class="form-group row">
                    <label for="job" class="col-sm-2 col-form-label">Position Job</label>
                    <div class="col-sm-10 col-md-8 col-lg-6">
                        <select class="form-control" name="job" required >
                            @foreach($jobs as $job)
                            <option value="{{$job->id}}">{{$job->description}}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">{{ $errors->first('job') }}</small>
                    </div>
                </div>
            @endif
            @if($wageTitles)
                <div class="form-group row">
                    <label for="wage_title" class="col-sm-2 col-form-label">Position Wage Title</label>
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
                    <button type="submit" class="btn btn-success" formaction="{{url('hr.positions')}}">Create Position</button>
                </div>
            </div>
        </form>
        <!-- </form> -->
        <hr class="border-info mt-4 mb-4 prevent-print"/>

        @if($positions)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Description</th>
                        <th scope="col">Job</th>
                        <th scope="col">Wage Title</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($positions as $position)
                    <tr class="clickable-row" data-href="{{ url('hr.positions/'.$position->id) }}">
                        <td>{{$position->description}}</td>
                        @foreach($position->job as $job)
                        <td>{{$job->description}}</td>
                        @endforeach
                        @foreach($position->wageTitle as $wageTitle)
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