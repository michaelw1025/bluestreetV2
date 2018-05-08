@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Wage Title<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')

        @if($wageTitle)

        <!-- <form> -->
        <form method="post" action="">
        {{ csrf_field() }}
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Wage Title Description</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="description" required value="{{$wageTitle->description}}">
                    <small class="text-danger">{{ $errors->first('description') }}</small>
                </div>
            </div>

            @if($wageProgressions)
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
                        @foreach($wageTitle->wageProgression as $titleProgression)
                        @if($titleProgression->id == $wageProgression->id)
                        <input type="text" class="form-control" name="progression[{{$loop->iteration}}][amount]" value="{{$titleProgression->pivot->amount}}" required>
                        @endif
                        @endforeach
                        </td>
                        @endforeach
                    </tr>
                <tbody>
            </table>
            @endif

            <div class="form-group row prevent-print">
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <button type="submit" class="btn btn-warning" formaction="{{url('hr.wage-titles/'.$wageTitle['id'].'/update')}}">Edit Wage Title</button>
                    <!-- <button type="submit" class="btn btn-danger delete-item" formaction="{{url('hr.wage-titles/'.$wageTitle['id'].'/delete')}}" name="wage title">Delete Wage Title</button> -->
                </div>
            </div>
        </form>
            <!-- </form> -->

            @endif

    </div>
</div>
@endsection