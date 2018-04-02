
        <h5 class="alert alert-info mt-5 toggle-section" id="employee-vision-insurance">Vision Insurance</h5>
        <p class="text-info prevent-print employee-vision-insurance d-none">* indicates a required field if Medical Plan is any value other than Waived</p>
        <div class="print-section form-row align-items-center employee-vision-insurance {{ $errors->has('vision_plan') ? '' : ($errors->has('vision_coverage_type') ? '' : ($errors->has('voucher_number') ? '' : 'd-none')) }}">
        
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="vision_plan">Vision Plan</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Vision Plan</div>
                    </div>
                    <select class="form-control vision-plan-select" name="vision_plan">
                        <option>Waived</option>
                        @if(isset($visionPlans))
                        @foreach($visionPlans as $visionPlan)
                        <option {{ isset($employee) ? ($employee->insuranceCoverageVisionPlan->isNotEmpty() ? ($employee->insuranceCoverageVisionPlan[0]->vision_plan_id == $visionPlan->id ? 'selected' : '') : '') : (old('vision_plan') == $visionPlan->id ? 'selected' : '') }} value="{{$visionPlan->id}}">{{$visionPlan->description}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('vision_plan') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="vision_coverage_type">Coverage Type</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-info prevent-print">*</span>&nbsp;Coverage Type</div>
                    </div>
                    @if(isset($visionPlans))
                    @foreach($visionPlans as $visionPlan)
                    <select class="form-control vision-coverage-types {{ isset($employee) ? ($employee->insuranceCoverageVisionPlan->isNotEmpty() ? ($employee->insuranceCoverageVisionPlan[0]->vision_plan_id == $visionPlan->id ? '' : 'd-none') : 'd-none') : 'd-none' }}" id="vision-coverage-{{$visionPlan->id}}" name="vision_coverage_type[{{$loop->index}}]">
                        <option></option>
                        @foreach($visionPlan->insuranceCoverage as $insuranceCoverage)
                        <option class="vision-coverage-option" {{ isset($employee) ? ($employee->insuranceCoverageVisionPlan->isNotEmpty() ? ($employee->insuranceCoverageVisionPlan[0]->id == $insuranceCoverage->pivot->id ? 'selected' : '') : '') : (old('vision_coverage_type') == $insuranceCoverage->pivot->id ? 'selected' : '') }} value="{{$insuranceCoverage->pivot->id}}">{{$insuranceCoverage->description}} &nbsp ${{$insuranceCoverage->pivot->amount}}</option>
                        @endforeach
                        
                        
                    </select>
                    @endforeach
                    @endif
                </div>
                <small class="text-danger">{{ $errors->first('vision_coverage_type') }}</small>
            </div>

            

        </div> <!-- end form row -->

        <hr class="print-section half-rule employee-vision-insurance mt-4 mb-4 d-none"/>
        <div class="print-section form-row align-items-center employee-vision-insurance d-none">
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="voucher_number">Voucher Number</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Voucher Number</div>
                    </div>
                    <input type="text" class="form-control" name="voucher_number" value="{{ old('voucher_number') }}">
                </div>
                <small class="text-danger">{{ $errors->first('voucher_number') }}</small>
            </div>

            @if(isset($employee))
            @foreach($employee->visionVoucher as $visionVoucher)
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="voucher_number_{{$visionVoucher->id}}">{{ $visionVoucher->created_at->format('m-d-Y') }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">{{ $visionVoucher->created_at->format('m-d-Y') }}</div>
                    </div>
                    <input type="text" disabled class="form-control" name="voucher_number_{{$visionVoucher->id}}" value="{{ $visionVoucher->voucher_number }}">
                </div>
                <small class="text-danger">{{ $errors->first('voucher_number') }}</small>
            </div>
            @endforeach
            @endif
        </div> <!-- end form row -->
