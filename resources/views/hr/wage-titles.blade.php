@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Wage Titles<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')

        <h3 class="prevent-print">Add Wage Title</h3>
        <!-- <form> -->
        <form method="post" action="" class="prevent-print">
        {{ csrf_field() }}
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Wage Title Description</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="description" required value="{{old('description')}}">
                    <small class="text-danger">{{ $errors->first('description') }}</small>
                </div>
            </div>

            @if($wageProgressions)
            <h6 class="alert alert-dark mt-3">Set Amount For Each Wage Progression</h6>
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        @foreach($wageProgressions as $wageProgression)
                        <th scope="col">{{$wageProgression->month}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr class="clickable-row" >
                        @foreach($wageProgressions as $wageProgression)
                        <td>
                        <input type="text" class="form-control d-none" name="progression[{{$loop->iteration}}][id]" value="{{$wageProgression->id}}" required>
                        <input type="text" class="form-control" name="progression[{{$loop->iteration}}][amount]" value="{{ old('amount'.$loop->iteration) ? old('amount'.$loop->iteration) : '0' }}" required>
                        </td>
                        @endforeach
                    </tr>
                <tbody>
            </table>
            @endif
            
            <div class="form-group row">
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <button type="submit" class="btn btn-success" formaction="{{url('hr.wage-titles')}}">Create Wage Title</button>
                </div>
            </div>
        </form>
        <!-- </form> -->
        <hr class="border-info mt-4 mb-4 prevent-print"/>

        @if($wageTitles)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Description</th>
                        @if($wageProgressions)
                        @foreach($wageProgressions as $wageProgression)
                        <th scope="col">{{$wageProgression->month}}</th>
                        @endforeach
                        @endif
                    </tr>
                </thead>
                <tbody>
                @foreach($wageTitles as $wageTitle)
                    <tr class="clickable-row" data-href="{{ url('hr.wage-titles/'.$wageTitle->id) }}">
                        <td>{{$wageTitle->description}}</td>
                        @foreach($wageTitle->wageProgression as $titleProgression)
                        @if($wageProgressions)
                        @foreach($wageProgressions as $wageProgression)
                        @if($titleProgression->id == $wageProgression->id)
                        <td>{{$titleProgression->pivot->amount}}</td>
                        @endif
                        @endforeach
                        @endif
                        @endforeach
                    </tr>
                @endforeach
                <tbody>
            </table>
        @endif
    </div>
</div>
@endsection