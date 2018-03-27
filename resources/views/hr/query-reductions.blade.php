@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Employee Reductions<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print reduction-column" id="voluntary-layoff">Voluntary Layoff</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print reduction-column" id="involuntary-layoff">Involuntary Layoff</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print reduction-column" id="voluntary-bump">Voluntary Bump</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print reduction-column" id="involuntary-bump">Involuntary Bump</button>
        <hr class="border-info prevent-print"/>

        @if($employees)
            <table class="table table-sm table-bordered mt-4">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">ID</th>
                        <th scope="col" class="">Hire Date</th>
                        <th scope="col" class="">Type</th>
                        <th scope="col" class="">Displacement</th>
                        <th scope="col" class="">Reduction Date</th>
                        <th scope="col" class="">Home CC</th>
                        <th scope="col" class="">Bump To CC</th>
                        <th scope="col" class="">Home Shift</th>
                        <th scope="col" class="">Bump To Shift</th>
                        <th scope="col" class="">Fiscal WK</th>
                        <th scope="col" class="">Fiscal YR</th>


                    </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                @foreach($employee->reduction as $reduction)
                    <tr class="clickable-row reduction-row {{$reduction->type == 'voluntary' ? 'voluntary' : 'involuntary'}}-{{$reduction->displacement == 'layoff' ? 'layoff' : 'bump'}} d-none" data-href="{{ url('hr.employees/'.$employee->id) }}">
                        <td>{{$employee->first_name}} {{$employee->last_name}}</td>
                        <td>{{$employee->id}}</td>
                        <td>{{$employee->hire_date->format('m-d-Y')}}</td>
                        <td>{{$reduction->type}}</td>
                        <td>{{$reduction->displacement}}</td>
                        <td>{{$reduction->date->format('m-d-Y')}}</td>
                        <td>@foreach($costCenters as $costCenter) {{$reduction->home_cost_center == $costCenter->id ? $costCenter->number : ''}} @endforeach</td>
                        <td>@foreach($costCenters as $costCenter) {{$reduction->bump_to_cost_center == $costCenter->id ? $costCenter->number : ''}} @endforeach</td>
                        <td>@foreach($shifts as $shift) {{$reduction->home_shift == $shift->id ? $shift->description : ''}} @endforeach</td>
                        <td>@foreach($shifts as $shift) {{$reduction->bump_to_shift == $shift->id ? $shift->description : ''}} @endforeach</td>
                        <td>{{$reduction->fiscal_week}}</td>
                        <td>{{$reduction->fiscal_year}}</td>
                    </tr>
                @endforeach
                @endforeach
                <tbody>
            </table>
        @endif
    </div>
</div>
@endsection