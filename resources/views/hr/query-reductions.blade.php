@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Employee Reductions<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print reduction-type-column" id="voluntary">Voluntary</button>
        <button type="button" class="btn btn-outline-primary mr-2 mt-2 prevent-print reduction-type-column" id="involuntary">Involuntary</button>

        <button type="button" class="btn btn-outline-success mr-2 mt-2 prevent-print reduction-displacement-column" id="layoff">Layoff</button>
        <button type="button" class="btn btn-outline-success mr-2 mt-2 prevent-print reduction-displacement-column" id="bump">Bump</button>
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

                    </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                @foreach($employee->reduction as $reduction)
                    <tr class="clickable-row reduction-type-row {{ $reduction->type == 'voluntary' ? 'voluntary' : 'involuntary' }} {{ $reduction->displacement == 'layoff' ? 'layoff' : 'bump' }} d-none" data-href="{{ url('hr.employees/'.$employee->id) }}">
                        <td>{{$employee->first_name}} {{$employee->last_name}}</td>
                        <td>{{$employee->id}}</td>
                        <td>{{$employee->hire_date}}</td>
                        <td>{{$reduction->type}}</td>
                        <td>{{$reduction->displacement}}</td>
                    </tr>
                @endforeach
                @endforeach
                <tbody>
            </table>
        @endif
    </div>
</div>
@endsection