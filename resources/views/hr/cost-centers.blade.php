@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Cost Centers <small class="text-muted">(Manage)</small><button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')

        @if(Auth::user()->navigationRoles(['admin', 'hrmanager', 'hruser']))
        <h3 class="prevent-print">Add Cost Center</h3>
        <!-- <form> -->
        <form method="post" action="" class="prevent-print">
        {{ csrf_field() }}
            <div class="form-group row">
                <label for="number" class="col-sm-2 col-form-label">Cost Center number</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="number" required value="{{old('number')}}">
                    <small class="text-danger">{{ $errors->first('number') }}</small>
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Cost Center Description</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="description" required value="{{old('description')}}">
                    <small class="text-danger">{{ $errors->first('description') }}</small>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <button type="submit" class="btn btn-success" formaction="{{url('hr.cost-centers')}}">Create Cost Center</button>
                </div>
            </div>
        </form>
        <!-- </form> -->
        <hr class="border-info mt-4 mb-4 prevent-print"/>
        @endif

        @if($costCenters)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Number</th>
                        <th scope="col">Description</th>
                        <th scope="col">Staff Manager</th>
                        <th scope="col">Day TM</th>
                        <th scope="col">Night TM</th>
                        <th scope="col">Day TL</th>
                        <th scope="col">Night TL</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($costCenters as $costCenter)
                    <tr class="clickable-row" data-href="{{ url('hr.cost-centers/'.$costCenter->id) }}">
                        <td>{{$costCenter->number}}</td>
                        <td>{{$costCenter->description}}</td>
                        <td>{{$costCenter->employeeStaffManager->isNotEmpty() ? $costCenter->employeeStaffManager[0]->first_name.' '.$costCenter->employeeStaffManager[0]->last_name : ''}}</td>
                        <td>{{$costCenter->employeeDayTeamManager->isNotEmpty() ? $costCenter->employeeDayTeamManager[0]->first_name.' '.$costCenter->employeeDayTeamManager[0]->last_name : ''}}</td>
                        <td>{{$costCenter->employeeNightTeamManager->isNotEmpty() ? $costCenter->employeeNightTeamManager[0]->first_name.' '.$costCenter->employeeNightTeamManager[0]->last_name : ''}}</td>
                        <td>{{$costCenter->employeeDayTeamLeader->isNotEmpty() ? $costCenter->employeeDayTeamLeader[0]->first_name.' '.$costCenter->employeeDayTeamLeader[0]->last_name : ''}}</td>
                        <td>{{$costCenter->employeeNightTeamLeader->isNotEmpty() ? $costCenter->employeeNightTeamLeader[0]->first_name.' '.$costCenter->employeeNightTeamLeader[0]->last_name : ''}}</td>
                    </tr>
                @endforeach
                <tbody>
            </table>
        @endif
    </div>
</div>
@endsection
