@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Insurance<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')





        <h5 class="alert alert-info mt-5 toggle-section" id="insurance-coverage">Insurance Coverage Types</h5>
        <div class="insurance-coverage d-none">
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
        </div>












        <h5 class="alert alert-info mt-5 toggle-section" id="medical-plans">Medical Plans</h5>
        <div class="medical-plans d-none">
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
                        @if($insuranceCoverages)
                        @foreach($insuranceCoverages as $insuranceCoverage)
                        <th scope="col">{{$insuranceCoverage->description}}</th>
                        @endforeach
                        @endif
                    </tr>
                </thead>
                <tbody>
                @foreach($medicalPlans as $medicalPlan)
                    <tr class="clickable-row" data-href="{{ url('hr.medical-plans/'.$medicalPlan->id) }}">
                        <td>{{$medicalPlan->description}}</td>
                        @if($insuranceCoverages)
                            @foreach($insuranceCoverages as $insuranceCoverage)
                                @foreach($medicalPlan->insuranceCoverage as $medicalCoverage)
                                    @if($medicalCoverage->id == $insuranceCoverage->id)
                                    <td>{{$medicalCoverage->pivot->amount}}</td>
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                    </tr>
                @endforeach
                <tbody>
            </table>
        @endif
        </div>















        <h5 class="alert alert-info mt-5 toggle-section" id="dental-plans">Dental Plans</h5>
        <div class="dental-plans d-none">
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
                        @if($insuranceCoverages)
                        @foreach($insuranceCoverages as $insuranceCoverage)
                        <th scope="col">{{$insuranceCoverage->description}}</th>
                        @endforeach
                        @endif
                    </tr>
                </thead>
                <tbody>
                @foreach($dentalPlans as $dentalPlan)
                    <tr class="clickable-row" data-href="{{ url('hr.dental-plans/'.$dentalPlan->id) }}">
                        <td>{{$dentalPlan->description}}</td>
                        @if($insuranceCoverages)
                            @foreach($insuranceCoverages as $insuranceCoverage)
                                @foreach($dentalPlan->insuranceCoverage as $dentalCoverage)
                                    @if($dentalCoverage->id == $insuranceCoverage->id)
                                    <td>{{$dentalCoverage->pivot->amount}}</td>
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                    </tr>
                @endforeach
                <tbody>
            </table>
        @endif
        </div>



















        <h5 class="alert alert-info mt-5 toggle-section" id="vision-plans">Vision Plans</h5>
        <div class="vision-plans d-none">
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
                        @if($insuranceCoverages)
                        @foreach($insuranceCoverages as $insuranceCoverage)
                        <th scope="col">{{$insuranceCoverage->description}}</th>
                        @endforeach
                        @endif
                    </tr>
                </thead>
                <tbody>
                @foreach($visionPlans as $visionPlan)
                    <tr class="clickable-row" data-href="{{ url('hr.vision-plans/'.$visionPlan->id) }}">
                        <td>{{$visionPlan->description}}</td>
                        @if($insuranceCoverages)
                            @foreach($insuranceCoverages as $insuranceCoverage)
                                @foreach($visionPlan->insuranceCoverage as $visionCoverage)
                                    @if($visionCoverage->id == $insuranceCoverage->id)
                                    <td>{{$visionCoverage->pivot->amount}}</td>
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                    </tr>
                @endforeach
                <tbody>
            </table>
        @endif
        </div>




















        <h5 class="alert alert-info mt-5 toggle-section" id="accidental-insurance">Accidental Insurance</h5>
        <div class="accidental-insurance d-none">
        <h5 class="prevent-print">Add Accidental Coverage</h5>
        <!-- <form> -->
        <form method="post" action="" class="prevent-print">
        {{ csrf_field() }}
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Accidental Coverage Description</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="description" required value="{{old('description')}}">
                    <small class="text-danger">{{ $errors->first('description') }}</small>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <button type="submit" class="btn btn-success" formaction="{{url('hr.accidental-coverages')}}">Create Accidental Coverage</button>
                </div>
            </div>
        </form>
        <!-- </form> -->
        <hr class="border-info mt-4 mb-4 prevent-print"/>

        @if($accidentalCoverages)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($accidentalCoverages as $accidentalCoverage)
                    <tr class="clickable-row" data-href="{{ url('hr.accidental-coverages/'.$accidentalCoverage->id) }}">
                        <td>{{$accidentalCoverage->description}}</td>
                    </tr>
                @endforeach
                <tbody>
            </table>
        @endif
        </div>









    </div>
</div>
@endsection