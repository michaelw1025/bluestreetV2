@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Vision Plan<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')

        @if($visionPlan)

        <!-- <form> -->
        <form method="post" action="">
        {{ csrf_field() }}
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Plan Description</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="description" required value="{{$visionPlan['description']}}">
                    <small class="text-danger">{{ $errors->first('description') }}</small>
                </div>
            </div>

            @if($insuranceCoverages)
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        @foreach($insuranceCoverages as $insuranceCoverage)
                        <th scope="col">{{$insuranceCoverage->description}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr class="clickable-row" >
                        @foreach($insuranceCoverages as $insuranceCoverage)
                        <td>
                        <input type="text" class="form-control d-none" name="coverage[{{$loop->iteration}}][id]" value="{{$insuranceCoverage->id}}" required>
                        @if(count($visionPlan->insuranceCoverage) > 0)
                                @foreach($visionPlan->insuranceCoverage as $planCoverage)
                                    @if($planCoverage->id == $insuranceCoverage->id)
                                        <input type="text" class="form-control" name="coverage[{{$loop->iteration}}][amount]" value="{{$planCoverage->pivot->amount}}" required>
                                    @endif
                                @endforeach
                            @else
                                <input type="text" class="form-control" name="coverage[{{$loop->iteration}}][amount]" value="0" required>
                            @endif
                        </td>
                        @endforeach
                    </tr>
                <tbody>
            </table>
            @endif

            <div class="form-group row prevent-print">
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <button type="submit" class="btn btn-warning" formaction="{{url('hr.vision-plans/'.$visionPlan['id'].'/update')}}">Edit Vision Plan</button>
                    <button type="submit" class="btn btn-danger delete-item" formaction="{{url('hr.vision-plans/'.$visionPlan['id'].'/delete')}}" name="vision plan">Delete Vision Plan</button>
                </div>
            </div>
        </form>
            <!-- </form> -->

            @endif

    </div>
</div>
@endsection