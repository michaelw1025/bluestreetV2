@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Create Bid</h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')

        <p class="text-danger prevent-print">* indicates a required field</p>

        <!-- <form> -->
        <form method="post" action="">
            {{ csrf_field() }}

            <div class="form-row align-items-center">
                <div class="col-xl-4 my-1">
                    <label class="sr-only" for="bid_post_number">Posting Number</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Posting Number {{$year->format('y')}}-</div>
                        </div>
                        <input type="text" class="form-control" name="bid_post_number" required value="01">
                    </div>
                    <small class="text-danger">{{ $errors->first('bid_post_number') }}</small>
                </div>

                <div class="col-xl-4 my-1">
                    <label class="sr-only" for="bid_post_date">Bid Post Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Bid Post Date</div>
                        </div>
                        <input type="text" class="form-control ui-datepicker-prev date-pick" name="bid_post_date" required value="">
                    </div>
                    <small class="text-danger">{{ $errors->first('bid_post_date') }}</small>
                </div>

                <div class="col-xl-4 my-1">
                    <label class="sr-only" for="bid_pull_date">Bid Pull Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Bid Pull Date</div>
                        </div>
                        <input type="text" class="form-control ui-datepicker-prev date-pick" name="bid_pull_date" required value="">
                    </div>
                    <small class="text-danger">{{ $errors->first('bid_pull_date') }}</small>
                </div>

                <div class="col-xl-4 my-1">
                    <label class="sr-only" for="bid_tech_form">Tech Form Required</label>
                    <div class="input-group border border-secondary">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Tech Form Required</div>
                        </div>
                        <div class="form-check form-check-inline ml-4">
                            <input class="form-check-input" type="checkbox" name="bid_tech_form" value="1">
                            <label class="form-check-label">Check if tech form is required</label>
                        </div>
                    </div>
                    <small class="text-danger">{{ $errors->first('bid_tech_form') }}</small>
                </div>

                <div class="col-xl-4 my-1">
                    <label class="sr-only" for="bid_resume">Resume Required</label>
                    <div class="input-group border border-secondary">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Resume Required</div>
                        </div>
                        <div class="form-check form-check-inline ml-4">
                            <input class="form-check-input" type="checkbox" name="bid_resume" value="1">
                            <label class="form-check-label">Check if resume is required</label>
                        </div>
                    </div>
                    <small class="text-danger">{{ $errors->first('bid_resume') }}</small>
                </div>

                <div class="col-xl-4 my-1">
                    <label class="sr-only" for="bid_openings">Number Of Openings</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Number Of Openings</div>
                        </div>
                        <input type="text" class="form-control" name="bid_openings" required value="">
                    </div>
                    <small class="text-danger">{{ $errors->first('bid_openings') }}</small>
                </div>

                <div class="col-xl-4 my-1">
                    <label class="sr-only" for="bid_team">Team</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Team</div>
                        </div>
                        <select class="form-control" name="bid_team">
                            <option></option>
                            @isset($teams)
                            @foreach($teams as $team)
                            <option value="{{$team->id}}">{{$team->description}}</option>
                            @endforeach
                            @endisset
                        </select>
                    </div>
                    <small class="text-danger">{{ $errors->first('bid_team') }}</small>
                </div>

                <div class="col-xl-4 my-1">
                    <label class="sr-only" for="bid_position">Position</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Position</div>
                        </div>
                        <select class="form-control bid-position-select" name="bid_position">
                            <option></option>
                            @isset($wageTitles)
                            @foreach($wageTitles as $wageTitle)
                            @foreach($wageTitle->position as $position)
                            <option value="{{$position->id}}">{{$position->description}}</option>
                            @endforeach
                            @endforeach
                            @endisset
                        </select>
                    </div>
                    <small class="text-danger">{{ $errors->first('bid_position') }}</small>
                </div>

                <div class="col-xl-4 my-1">
                    <label class="sr-only" for="bid_shift">Shift</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Shift</div>
                        </div>
                        <select class="form-control" name="bid_shift">
                            <option></option>
                            @isset($shifts)
                            @foreach($shifts as $shift)
                            <option value="{{$shift->id}}">{{$shift->description}}</option>
                            @endforeach
                            @endisset
                        </select>
                    </div>
                    <small class="text-danger">{{ $errors->first('bid_shift') }}</small>
                </div>

                @isset($wageTitles)
                <div class="col-xl-4 my-1">
                    <label class="sr-only" for="bid_top_pay">Top Pay (no education requirement)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Top Pay (no education requirement)</div>
                        </div>
                        <select class="form-control" name="bid_top_pay">
                        <option></option>
                        @foreach($wageTitles as $wageTitle)  
                            <optgroup label="{{$wageTitle->description}}">
                            @foreach($wageTitle->wageProgression as $wageProgression)
                            <option value="{{$wageProgression->pivot->id}}">{{$wageProgression->month}} - {{$wageProgression->pivot->amount}}</option>
                            @endforeach
                            </optgroup>
                        @endforeach
                        </select>
                    </div>
                    <small class="text-danger">{{ $errors->first('bid_top_pay') }}</small>
                </div>
                @endisset

                <div class="col-xl-4 my-1">
                    <label class="sr-only" for="bid_education_requirement">Education Requirement</label>
                    <div class="input-group border border-secondary">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Education Requirement</div>
                        </div>
                        <div class="form-check form-check-inline ml-4">
                            <input class="form-check-input" type="checkbox" name="bid_education_requirement" value="1">
                            <label class="form-check-label">Check if top pay is limited by education requirement</label>
                        </div>
                    </div>
                    <small class="text-danger">{{ $errors->first('bid_education_requirement') }}</small>
                </div>

                @isset($wageTitles)
                <div class="col-xl-4 my-1">
                    <label class="sr-only" for="bid_top_pay_education">Top Pay (education requirement)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Top Pay (education requirement)</div>
                        </div>
                        <select class="form-control" name="bid_top_pay_education">
                        <option></option>
                        @foreach($wageTitles as $wageTitle)  
                            <optgroup label="{{$wageTitle->description}}">
                            @foreach($wageTitle->wageProgression as $wageProgression)
                            <option value="{{$wageProgression->pivot->id}}">{{$wageProgression->month}} - {{$wageProgression->pivot->amount}}</option>
                            @endforeach
                            </optgroup>
                        @endforeach
                        </select>
                    </div>
                    <small class="text-danger">{{ $errors->first('bid_top_pay_education') }}</small>
                </div>
                @endisset

                <div class="input-group col-xl-12 mt-1 mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Essential Duties and Responsibilities</span>
                    </div>
                    <textarea class="form-control" name="bid_essential_duties" rows="20">{{old('bid_essential_duties')}}</textarea>
                </div>
                <small class="text-danger">{{ $errors->first('bid_essential_duties') }}</small>

                <div class="input-group col-xl-6 mt-1 mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Summary</span>
                    </div>
                    <textarea class="form-control" name="bid_summary" rows="8">{{old('bid_summary')}}</textarea>
                </div>
                <small class="text-danger">{{ $errors->first('bid_summary') }}</small>

                <div class="input-group col-xl-6 mt-1 mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Qualifications</span>
                    </div>
                    <textarea class="form-control" name="bid_qualification" rows="8">{{old('bid_qualification')}}</textarea>
                </div>
                <small class="text-danger">{{ $errors->first('bid_qualification') }}</small>

                <div class="input-group col-xl-6 mt-1 mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Math Skills</span>
                    </div>
                    <textarea class="form-control" name="bid_math_skills" rows="8">{{old('bid_math_skills')}}</textarea>
                </div>
                <small class="text-danger">{{ $errors->first('bid_math_skills') }}</small>

                <div class="input-group col-xl-6 mt-1 mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Physical Demands</span>
                    </div>
                    <textarea class="form-control" name="bid_physical_demands" rows="8">{{old('bid_physical_demands')}}</textarea>
                </div>
                <small class="text-danger">{{ $errors->first('bid_physical_demands') }}</small>
            
            </div>
            


        <div class="form-group row prevent-print mt-4">
            <div class="col-sm-10 col-md-8 col-lg-6">
                <input type="text" class="d-none" name="create_bid" value="create">
                <button type="submit" class="btn btn-success update-bid" formaction="{{url('hr.store-bid')}}">Create Bid</button>
            </div>
        </div>


        </form>
        <!-- </form> -->

    </div>
</div>
@endsection