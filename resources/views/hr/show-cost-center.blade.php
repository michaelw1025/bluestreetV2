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
                        <option></option>
                            @foreach($salaryEmployees as $salaryEmployee)
                            @foreach($salaryEmployee->employee as $employee)
                            <option {{ $costCenter->employeeStaffManager->isNotEmpty() ? ($costCenter->employeeStaffManager[0]->employee_id == $employee->pivot->employee_id ? 'selected' : '') : '' }} value="{{$employee->pivot->employee_id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                            @endforeach
                            @endforeach
                        </select>
                        
                    </div>
                </div>

                <div class="form-group row">
                    <label for="day_team_manager" class="col-sm-2 col-form-label">Day Team Manager</label>
                    <div class="col-sm-10 col-md-8 col-lg-6">
                        <select class="form-control" name="day_team_manager">
                        <option></option>
                            @foreach($salaryEmployees as $salaryEmployee)
                            @foreach($salaryEmployee->employee as $employee)
                            <option {{ $costCenter->employeeDayTeamManager->isNotEmpty() ? ($costCenter->employeeDayTeamManager[0]->employee_id == $employee->pivot->employee_id ? 'selected' : '') : '' }} value="{{$employee->pivot->employee_id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                            @endforeach
                            @endforeach
                        </select>
                        
                    </div>
                </div>

                <div class="form-group row">
                    <label for="night_team_manager" class="col-sm-2 col-form-label">Night Team Manager</label>
                    <div class="col-sm-10 col-md-8 col-lg-6">
                        <select class="form-control" name="night_team_manager">
                        <option></option>
                            @foreach($salaryEmployees as $salaryEmployee)
                            @foreach($salaryEmployee->employee as $employee)
                            <option {{ $costCenter->employeeNightTeamManager->isNotEmpty() ? ($costCenter->employeeNightTeamManager[0]->employee_id == $employee->pivot->employee_id ? 'selected' : '') : '' }} value="{{$employee->pivot->employee_id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                            @endforeach
                            @endforeach
                        </select>
                        
                    </div>
                </div>

                <div class="form-group row">
                    <label for="day_team_leader" class="col-sm-2 col-form-label">Day Team Leader</label>
                    <div class="col-sm-10 col-md-8 col-lg-6">
                        <select class="form-control" name="day_team_leader">
                        <option></option>
                            @foreach($salaryEmployees as $salaryEmployee)
                            @foreach($salaryEmployee->employee as $employee)
                            <option {{ $costCenter->employeeDayTeamLeader->isNotEmpty() ? ($costCenter->employeeDayTeamLeader[0]->employee_id == $employee->pivot->employee_id ? 'selected' : '') : '' }} value="{{$employee->pivot->employee_id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
                            @endforeach
                            @endforeach
                        </select>
                        
                    </div>
                </div>

                <div class="form-group row">
                    <label for="night_team_leader" class="col-sm-2 col-form-label">Night Team Leader</label>
                    <div class="col-sm-10 col-md-8 col-lg-6">
                        <select class="form-control" name="night_team_leader">
                        <option></option>
                            @foreach($salaryEmployees as $salaryEmployee)
                            @foreach($salaryEmployee->employee as $employee)
                            <option {{ $costCenter->employeeNightTeamLeader->isNotEmpty() ? ($costCenter->employeeNightTeamLeader[0]->employee_id == $employee->pivot->employee_id ? 'selected' : '') : '' }} value="{{$employee->pivot->employee_id}}">{{$employee->first_name}} {{$employee->last_name}}</option>
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
                    <button type="submit" class="btn btn-danger delete-item" formaction="{{url('hr.cost-centers/'.$costCenter['id'].'/delete')}}" name="cost center">Delete Cost Center</button>
                </div>
            </div>
            @endif
        </form>
            <!-- </form> -->

            @endif


    </div>
</div>
@endsection