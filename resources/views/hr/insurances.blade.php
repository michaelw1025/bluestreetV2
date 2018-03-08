@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Insurance<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')






        <h5 class="alert alert-info mt-5">Insurance Coverage Types</h5>
        <h5 class="prevent-print">Add Insurance Coverage Type</h5>
        <!-- <form> -->
        <form method="post" action="" class="prevent-print">
        {{ csrf_field() }}
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Coverage Type Description</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="description" required value="{{old('description')}}">
                    <small class="text-danger">{{ $errors->first('description') }}</small>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <button type="submit" class="btn btn-success" formaction="{{url('hr.insurance-coverages')}}">Create Coverage Type</button>
                </div>
            </div>
        </form>
        <!-- </form> -->
        <hr class="border-info mt-4 mb-4 prevent-print"/>

        @if($insuranceCoverages)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($insuranceCoverages as $insuranceCoverage)
                    <tr class="clickable-row" data-href="{{ url('hr.insurance-coverages/'.$insuranceCoverage->id) }}">
                        <td>{{$insuranceCoverage->description}}</td>
                    </tr>
                @endforeach
                <tbody>
            </table>
        @endif












        <h5 class="alert alert-info mt-5">Medical Plans</h5>
        <h5 class="prevent-print">Add Medical Plan</h5>
        <!-- <form> -->
        <form method="post" action="" class="prevent-print">
        {{ csrf_field() }}
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Medical Plan Description</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="description" required value="{{old('description')}}">
                    <small class="text-danger">{{ $errors->first('description') }}</small>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <button type="submit" class="btn btn-success" formaction="{{url('hr.medical-plans')}}">Create Medical Plan</button>
                </div>
            </div>
        </form>
        <!-- </form> -->
        <hr class="border-info mt-4 mb-4 prevent-print"/>

        @if($medicalPlans)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($medicalPlans as $medicalPlan)
                    <tr class="clickable-row" data-href="{{ url('hr.medical-plans/'.$medicalPlan->id) }}">
                        <td>{{$medicalPlan->description}}</td>
                    </tr>
                @endforeach
                <tbody>
            </table>
        @endif


















        <h5 class="alert alert-info mt-5">Dental Plans</h5>
        <h5 class="prevent-print">Add Dental Plan</h5>
        <!-- <form> -->
        <form method="post" action="" class="prevent-print">
        {{ csrf_field() }}
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Dental Plan Description</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="description" required value="{{old('description')}}">
                    <small class="text-danger">{{ $errors->first('description') }}</small>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <button type="submit" class="btn btn-success" formaction="{{url('hr.dental-plans')}}">Create Dental Plan</button>
                </div>
            </div>
        </form>
        <!-- </form> -->
        <hr class="border-info mt-4 mb-4 prevent-print"/>

        @if($dentalPlans)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($dentalPlans as $dentalPlan)
                    <tr class="clickable-row" data-href="{{ url('hr.dental-plans/'.$dentalPlan->id) }}">
                        <td>{{$dentalPlan->description}}</td>
                    </tr>
                @endforeach
                <tbody>
            </table>
        @endif




















        <h5 class="alert alert-info mt-5">Vision Plans</h5>
        <h5 class="prevent-print">Add Vision Plan</h5>
        <!-- <form> -->
        <form method="post" action="" class="prevent-print">
        {{ csrf_field() }}
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Vision Plan Description</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="description" required value="{{old('description')}}">
                    <small class="text-danger">{{ $errors->first('description') }}</small>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <button type="submit" class="btn btn-success" formaction="{{url('hr.vision-plans')}}">Create Vision Plan</button>
                </div>
            </div>
        </form>
        <!-- </form> -->
        <hr class="border-info mt-4 mb-4 prevent-print"/>

        @if($visionPlans)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($visionPlans as $visionPlan)
                    <tr class="clickable-row" data-href="{{ url('hr.vision-plans/'.$visionPlan->id) }}">
                        <td>{{$visionPlan->description}}</td>
                    </tr>
                @endforeach
                <tbody>
            </table>
        @endif










    </div>
</div>
@endsection