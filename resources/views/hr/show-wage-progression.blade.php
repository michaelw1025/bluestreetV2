@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Wage Progression<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')

        @if($wageProgression)

        <!-- <form> -->
        <form method="post" action="">
        {{ csrf_field() }}
            <div class="form-group row">
                <label for="month" class="col-sm-2 col-form-label">Wage Progression Month Amount</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="month" required value="{{$wageProgression['month']}}">
                    <small class="text-danger">{{ $errors->first('month') }}</small>
                </div>
            </div>
            @if(Auth::user()->navigationRoles(['admin', 'hrmanager', 'hruser']))
            <div class="form-group row prevent-print">
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <button type="submit" class="btn btn-warning" formaction="{{url('hr.wage-progressions/'.$wageProgression['id'].'/update')}}">Edit Wage Progression</button>
                    <!-- <button type="submit" class="btn btn-danger delete-item" formaction="{{url('hr.wage-progressions/'.$wageProgression['id'].'/delete')}}" name="wage progression">Delete Wage Progression</button> -->
                </div>
            </div>
            @endif
        </form>
            <!-- </form> -->

            @endif

    </div>
</div>
@endsection
