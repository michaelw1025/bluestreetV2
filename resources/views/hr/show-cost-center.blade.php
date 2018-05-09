@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Cost Center<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')

        @if($costCenter)

        <!-- <form> -->
        <form method="post" action="">
        {{ csrf_field() }}
            <div class="form-group row">
                <label for="number" class="col-sm-2 col-form-label">Cost Center Number</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="number" required value="{{$costCenter['number']}}">
                    <small class="text-danger">{{ $errors->first('number') }}</small>
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Cost Center Description</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="description" required value="{{$costCenter['description']}}">
                    <small class="text-danger">{{ $errors->first('description') }}</small>
                </div>
            </div>

            @if($salaryEmployees)
                <div class="form-group row">
                    <label for="staff_manager" class="col-sm-2 col-form-label">Staff Manager</label>
                    <div class="col-sm-10 col-md-8 col-lg-6">
                        <select class="form-control" name="staff_manager">
                            @if($costCenter->employeeStaffManager->isNotEmpty())
                                @foreach($costCenter->employeeStaffManager as $staffManager)
                                <option value="{{$staffManager->employee_id}}" "selected">{{$staffManager->first_name}} {{$staffManager->last_name}}</option>
                                @endforeach
                            @else
                                <option></option>
                            @endif

                            @foreach($salaryEmployees as $salaryEmployee)
                            @foreach($salaryEmployee->employee as $employee)
                            <option value="{{$employee->pivot->employee_id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                            @endforeach
                            @endforeach
                        </select>
                        
                    </div>
                </div>

                <div class="form-group row">
                    <label for="day_team_manager" class="col-sm-2 col-form-label">Day Team Manager</label>
                    <div class="col-sm-10 col-md-8 col-lg-6">
                        <select class="form-control" name="day_team_manager">
                            @if($costCenter->employeeDayTeamManager->isNotEmpty())
                                @foreach($costCenter->employeeDayTeamManager as $dayTeamManager)
                                <option value="{{$dayTeamManager->employee_id}}" "selected">{{$dayTeamManager->first_name}} {{$dayTeamManager->last_name}}</option>
                                @endforeach
                            @else
                                <option></option>
                            @endif

                            @foreach($salaryEmployees as $salaryEmployee)
                            @foreach($salaryEmployee->employee as $employee)
                            <option value="{{$employee->pivot->employee_id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                            @endforeach
                            @endforeach
                        </select>
                        
                    </div>
                </div>

                <div class="form-group row">
                    <label for="night_team_manager" class="col-sm-2 col-form-label">Night Team Manager</label>
                    <div class="col-sm-10 col-md-8 col-lg-6">
                        <select class="form-control" name="night_team_manager">
                            @if($costCenter->employeeNightTeamManager->isNotEmpty())
                                @foreach($costCenter->employeeNightTeamManager as $nightTeamManager)
                                <option value="{{$nightTeamManager->employee_id}}" "selected">{{$nightTeamManager->first_name}} {{$nightTeamManager->last_name}}</option>
                                @endforeach
                            @else
                                <option></option>
                            @endif

                            @foreach($salaryEmployees as $salaryEmployee)
                            @foreach($salaryEmployee->employee as $employee)
                            <option value="{{$employee->pivot->employee_id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                            @endforeach
                            @endforeach
                        </select>
                        
                    </div>
                </div>

                <div class="form-group row">
                    <label for="day_team_leader" class="col-sm-2 col-form-label">Day Team Leader</label>
                    <div class="col-sm-10 col-md-8 col-lg-6">
                        <select class="form-control" name="day_team_leader">
                            @if($costCenter->employeeDayTeamLeader->isNotEmpty())
                                @foreach($costCenter->employeeDayTeamLeader as $dayTeamLeader)
                                <option value="{{$dayTeamLeader->employee_id}}" "selected">{{$dayTeamLeader->first_name}} {{$dayTeamLeader->last_name}}</option>
                                @endforeach
                            @else
                                <option></option>
                            @endif

                            @foreach($salaryEmployees as $salaryEmployee)
                            @foreach($salaryEmployee->employee as $employee)
                            <option value="{{$employee->pivot->employee_id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                            @endforeach
                            @endforeach
                        </select>
                        
                    </div>
                </div>

                <div class="form-group row">
                    <label for="night_team_leader" class="col-sm-2 col-form-label">Night Team Leader</label>
                    <div class="col-sm-10 col-md-8 col-lg-6">
                        <select class="form-control" name="night_team_leader">
                            @if($costCenter->employeeNightTeamLeader->isNotEmpty())
                                @foreach($costCenter->employeeNightTeamLeader as $nightTeamLeader)
                                <option value="{{$nightTeamLeader->employee_id}}" "selected">{{$nightTeamLeader->first_name}} {{$nightTeamLeader->last_name}}</option>
                                @endforeach
                            @else
                                <option></option>
                            @endif

                            @foreach($salaryEmployees as $salaryEmployee)
                            @foreach($salaryEmployee->employee as $employee)
                            <option value="{{$employee->pivot->employee_id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                            @endforeach
                            @endforeach
                        </select>
                        
                    </div>
                </div>
                
            @endif

            @if(Auth::user()->navigationRoles(['admin', 'hrmanager', 'hruser']))
            <div class="form-group row prevent-print">
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <button type="submit" class="btn btn-warning" formaction="{{url('hr.cost-centers/'.$costCenter['id'].'/update')}}">Edit Cost Center</button>
                    <!-- <button type="submit" class="btn btn-danger delete-item" formaction="{{url('hr.cost-centers/'.$costCenter['id'].'/delete')}}" name="cost center">Delete Cost Center</button> -->
                </div>
            </div>
            @endif
        </form>
            <!-- </form> -->

    @endif


    </div>
</div>
@endsection