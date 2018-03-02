@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Cost Centers<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')

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

        @if($costCenters)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Number</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($costCenters as $costCenter)
                    <tr class="clickable-row" data-href="{{ url('hr.cost-centers/'.$costCenter->id) }}">
                        <td>{{$costCenter->number}}</td>
                        <td>{{$costCenter->description}}</td>
                    </tr>
                @endforeach
                <tbody>
            </table>
        @endif
    </div>
</div>
@endsection