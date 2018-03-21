
        <h5 class="alert alert-info mt-5 toggle-section" id="employee-health-insurance">Health Insurance</h5>
        <div class="form-row align-items-center employee-health-insurance {{ $errors->has('vitality_incentive') ? '' : ($errors->has('flex_spending_amount') ? '' : ($errors->has('hsa_amount') ? '' : ($errors->has('child_care_spending_amount') ? '' : 'd-none'))) }}">
        
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="vitality_incentive">Vitality Incentive</label>
                <div class="input-group border border-secondary {{ isset($employee->vitality_incentive) ? ($employee->vitality_incentive == '1' ? 'bg-success text-white' : '') : (old('vitality_incentive') == '1' ? 'bg-success text-white' : '') }}">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Vitality Incentive</div>
                    </div>
                    <div class="form-check form-check-inline ml-4">
                        <input class="form-check-input toggle-add-item" type="checkbox" name="vitality_incentive" value="1" {{ isset($employee->vitality_incentive) ? ($employee->vitality_incentive == '1' ? 'checked' : '') : (old('vitality_incentive') == '1' ? 'checked' : '') }}>
                        <label class="form-check-label">Check If Eligible</label>
                    </div>
                </div>
                <small class="text-danger">{{ $errors->first('vitality_incentive') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="flex_spending_amount">Flex Spending Amount</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Flex Spending Amount</div>
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="text" class="form-control" name="flex_spending_amount"  value="{{ isset($employee->flex_spending_amount) ? $employee->flex_spending_amount : old('flex_spending_amount') }}">
                </div>
                <small class="text-danger">{{ $errors->first('flex_spending_amount') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="hsa_amount">HSA Amount</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">HSA Amount</div>
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="text" class="form-control" name="hsa_amount"  value="{{ isset($employee->hsa_amount) ? $employee->hsa_amount : old('hsa_amount') }}">
                </div>
                <small class="text-danger">{{ $errors->first('hsa_amount') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="child_care_spending_amount">Child Care Spending Amount</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Child Care Spending Amount</div>
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="text" class="form-control" name="child_care_spending_amount"  value="{{ isset($employee->child_care_spending_amount) ? $employee->child_care_spending_amount : old('child_care_spending_amount') }}">
                </div>
                <small class="text-danger">{{ $errors->first('child_care_spending_amount') }}</small>
            </div>

        </div> <!-- end form row -->
@if(isset($employee))
        @if(!empty($employee->spouse))
        <hr class="half-rule employee-health-insurance mt-4 mb-4 d-none"/>
        <div class="mt-3 form-row align-items-center employee-health-insurance d-none">

            <div class="col-xl-12 my-1">
                <label class="sr-only" for="">Spouse</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">{{$employee->spouse->first_name}} {{$employee->spouse->last_name}}</div>
                    </div>
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-primary text-white">Medical</div>
                    </div>
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-primary text-white">
                        <input type="checkbox" name="spouse_medical_{{$employee->spouse->id}}" value="1" {{ $employee->spouse->has_medical == '1' ? 'checked' : '' }}>
                        </div>
                    </div>
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-info text-white">Dental</div>
                    </div>
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-info text-white">
                        <input type="checkbox" name="spouse_dental_{{$employee->spouse->id}}" value="1" {{ $employee->spouse->has_dental == '1' ? 'checked' : '' }}>
                        </div>
                    </div>
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-success text-white">Vision</div>
                    </div>
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-success text-white">
                        <input type="checkbox" name="spouse_vision_{{$employee->spouse->id}}" value="1" {{ $employee->spouse->has_vision == '1' ? 'checked' : '' }}>
                        </div>
                    </div>
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-dark text-white">Court Ordered</div>
                    </div>
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-dark text-white">
                        <input type="checkbox" name="spouse_court_ordered_{{$employee->spouse->id}}" value="1" {{ $employee->spouse->court_ordered == '1' ? 'checked' : '' }}>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- end form row -->
        @endif

        @if(!empty($employee->dependant))
        <hr class="half-rule employee-health-insurance mt-4 mb-4 d-none"/>
        <div class="mt-3 form-row align-items-center employee-health-insurance d-none">
        @foreach($employee->dependant as $dependant)
            <div class="col-xl-12 my-1 mt-4">
                <label class="sr-only" for="">Dependant</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">{{$dependant->first_name}} {{$dependant->last_name}}</div>
                    </div>
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-primary text-white">Medical</div>
                    </div>
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-primary text-white">
                        <input type="checkbox" name="dependant_medical_{{$dependant->id}}" value="1" {{ $dependant->has_medical == '1' ? 'checked' : '' }}>
                        </div>
                    </div>
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-info text-white">Dental</div>
                    </div>
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-info text-white">
                        <input type="checkbox" name="dependant_dental_{{$dependant->id}}" value="1" {{ $dependant->has_dental == '1' ? 'checked' : '' }}>
                        </div>
                    </div>
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-success text-white">Vision</div>
                    </div>
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-success text-white">
                        <input type="checkbox" name="dependant_vision_{{$dependant->id}}" value="1" {{ $dependant->has_vision == '1' ? 'checked' : '' }}>
                        </div>
                    </div>
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-dark text-white">Court Ordered</div>
                    </div>
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-dark text-white">
                        <input type="checkbox" name="dependant_court_ordered_{{$dependant->id}}" value="1" {{ $dependant->court_ordered == '1' ? 'checked' : '' }}>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div> <!-- end form row -->
        @endif

@endif