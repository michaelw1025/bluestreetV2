@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Wage Progressions <small class="text-muted">(Manage)</small><button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')

        <h3 class="prevent-print">Add Wage Progression</h3>
        <!-- <form> -->
        <form method="post" action="" class="prevent-print">
        {{ csrf_field() }}
            <div class="form-group row">
                <label for="month" class="col-sm-2 col-form-label">Wage Progression Month Amount</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="month" required value="{{old('month')}}">
                    <small class="text-danger">{{ $errors->first('month') }}</small>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <button type="submit" class="btn btn-success" formaction="{{url('hr.wage-progressions')}}">Create Wage Progression</button>
                </div>
            </div>
        </form>
        <!-- </form> -->
        <hr class="border-info mt-4 mb-4 prevent-print"/>

        @if($wageProgressions)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Month Amount</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($wageProgressions as $wageProgression)
                    <tr class="clickable-row" data-href="{{ url('hr.wage-progressions/'.$wageProgression->id) }}">
                        <td>{{$wageProgression->month}}</td>
                    </tr>
                @endforeach
                <tbody>
            </table>
        @endif
    </div>
</div>
@endsection
