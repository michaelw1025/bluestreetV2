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
                    <input type="text" class="form-control" name="description" required value="{{$job['description']}}">
                    <small class="text-danger">{{ $errors->first('description') }}</small>
                </div>
            </div>
            @if(Auth::user()->navigationRoles(['admin', 'hrmanager', 'hruser']))
            <div class="form-group row prevent-print">
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <button type="submit" class="btn btn-warning" formaction="{{url('hr.jobs/'.$job['id'].'/update')}}">Edit Job</button>
                    <!-- <button type="submit" class="btn btn-danger delete-item" formaction="{{url('hr.jobs/'.$job['id'].'/delete')}}" name="job">Delete Job</button> -->
                </div>
            </div>
            @endif
        </form>
            <!-- </form> -->

            @endif

    </div>
</div>
@endsection
