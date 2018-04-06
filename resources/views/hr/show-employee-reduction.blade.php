@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Reduction<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')

        @if($reduction)
        <nav class="nav">
        <a class="nav-link h3 text-primary" href="{{url('hr.employees/'.$reduction->employee->id)}}">{{$reduction->employee->first_name}} {{$reduction->employee->last_name}}</a>
        </nav>

        <!-- <form> -->
        <form method="post" action="{{route('hr.employee-reduction-update')}}">
        {{ csrf_field() }}


        <div class="form-row align-items-center employee-reduction ">

        <div class="col-xl-4 my-1">
                <label class="sr-only" for="reduction_update">Add Reduction</label>
                <div class="input-group border border-secondary">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Add Reduction</div>
                    </div>
                    <div class="form-check form-check-inline ml-4">
                        <input class="form-check-input" type="checkbox" name="reduction_update" value="1" {{$reduction->currently_active == '1' ? 'checked' : ''}}>
                        <label class="form-check-label">Check to Set This Reduction as Active</label>
                    </div>
                </div>
            </div>

        <div class="col-xl-4 my-1">
            <label class="sr-only" for="reduction_type">Reduction Type</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Reduction Type</div>
                </div>
                <select class="form-control" name="reduction_type">
                    <option></option>
                    <option {{ $reduction->type == 'voluntary' ? 'selected' : '' }} value="voluntary">Voluntary</option>
                    <option {{ $reduction->type == 'involuntary' ? 'selected' : '' }} value="involuntary">Involuntary</option>
                </select>
            </div>
            <small class="text-danger">{{ $errors->first('reduction_type') }}</small>
        </div>

        <div class="col-xl-4 my-1">
            <label class="sr-only" for="reduction_displacement">Reduction Displacement</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Reduction Displacement</div>
                </div>
                <select class="form-control" name="reduction_displacement">
                    <option></option>
                    <option {{ $reduction->displacement == 'layoff' ? 'selected' : '' }} value="layoff">Layoff</option>
                    <option {{ $reduction->displacement == 'bump' ? 'selected' : '' }} value="bump">Bump</option>
                </select>
            </div>
            <small class="text-danger">{{ $errors->first('reduction_displacement') }}</small>
        </div>

        <div class="col-xl-4 my-1">
            <label class="sr-only" for="reduction_date">Reduction Date</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Reduction Date</div>
                </div>
                <input type="text" class="form-control ui-datepicker-prev date-pick" name="reduction_date" value="{{ $reduction->date->format('m-d-Y') }}">
            </div>
            <small class="text-danger">{{ $errors->first('reduction_date') }}</small>
        </div>

        @if(isset($costCenters))
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="reduction_home_cost_center">Home Cost Center</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Home Cost Center</div>
                    </div>
                    <select class="form-control" name="reduction_home_cost_center">
                        <option></option>
                        @foreach($costCenters as $costCenter)
                        <option {{ $reduction->home_cost_center == $costCenter->id ? 'selected' : '' }} value="{{$costCenter->id}}">{{$costCenter->number}} - {{$costCenter->description}}</option>
                        @endforeach
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('reduction_home_cost_center') }}</small>
            </div>
            @endif

            @if(isset($costCenters))
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="reduction_bump_to_cost_center">Bump To Cost Center</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Bump To Cost Center</div>
                    </div>
                    <select class="form-control" name="reduction_bump_to_cost_center">
                        <option></option>
                        @foreach($costCenters as $costCenter)
                        <option {{ $reduction->bump_to_cost_center == $costCenter->id ? 'selected' : '' }} value="{{$costCenter->id}}">{{$costCenter->number}} - {{$costCenter->description}}</option>
                        @endforeach
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('reduction_bump_to_cost_center') }}</small>
            </div>
            @endif

            @if(isset($shifts))
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="reduction_home_shift">Home Shift</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Home Shift</div>
                    </div>
                    <select class="form-control" name="reduction_home_shift">
                        <option></option>
                        @foreach($shifts as $shift)
                        <option {{ $reduction->home_shift == $shift->id ? 'selected' : '' }} value="{{$shift->id}}">{{$shift->description}}</option>
                        @endforeach
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('reduction_home_shift') }}</small>
            </div>
            @endif

            @if(isset($shifts))
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="reduction_bump_to_shift">Bump To Shift</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Bump To Shift</div>
                    </div>
                    <select class="form-control" name="reduction_bump_to_shift">
                        <option></option>
                        @foreach($shifts as $shift)
                        <option {{ $reduction->bump_to_shift == $shift->id ? 'selected' : '' }} value="{{$shift->id}}">{{$shift->description}}</option>
                        @endforeach
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('reduction_bump_to_shift') }}</small>
            </div>
            @endif

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="reduction_fiscal_week">Fiscal Week</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Fiscal Week</div>
                    </div>
                    <input type="text" class="form-control" name="reduction_fiscal_week" value="{{$reduction->fiscal_week}}">
                </div>
                <small class="text-danger">{{ $errors->first('reduction_fiscal_week') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="reduction_fiscal_year">Fiscal Year</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Fiscal Year</div>
                    </div>
                    <input type="text" class="form-control" name="reduction_fiscal_year" value="{{$reduction->fiscal_year}}">
                </div>
                <small class="text-danger">{{ $errors->first('reduction_fiscal_year') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="reduction_return_date">Return Date</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Return Date</div>
                    </div>
                    <input type="text" class="form-control ui-datepicker-prev date-pick" name="reduction_return_date" value="{{ isset($reduction->return_date) ? $reduction->return_date->format('m-d-Y') : ''}}">
                </div>
                <small class="text-danger">{{ $errors->first('reduction_return_date') }}</small>
            </div>

        <div class="input-group my-1 ml-1 mr-1">
            <div class="input-group-prepend">
                <span class="input-group-text">Reduction Comments</span>
            </div>
            <textarea class="form-control" name="reduction_comments">{{ $reduction->comments }}</textarea>
        </div>

        </div> <!-- end form row -->

        <div class="form-group row prevent-print mt-4">
            <div class="col-sm-10 col-md-8 col-lg-6">
                <input type="text" class="d-none" value="{{$reduction->id}}" name="reduction_id">
                <input type="text" class="d-none" value="{{$reduction->employee->id}}" name="employee_id">
                <button type="submit" class="btn btn-warning update-reduction" name="update_reduction" value="update">Edit Reduction</button>
                <button type="submit" class="btn btn-danger delete-reduction delete-item" name="reduction" value="delete">Delete Reduction</button>
            </div>
        </div>



            
        </form>
            <!-- </form> -->

        @endif

    </div>
</div>
@endsection