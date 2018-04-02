
        <h5 class="alert alert-info mt-5 toggle-section" id="employee-dental-insurance">Dental Insurance</h5>
        <p class="text-info prevent-print employee-dental-insurance d-none">* indicates a required field if Dental Plan is any value other than Waived</p>
        <div class="print-section form-row align-items-center employee-dental-insurance {{ $errors->has('dental_plan') ? '' : ($errors->has('dental_coverage_type') ? '' : 'd-none') }}">
        
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="dental_plan">Dental Plan</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Dental Plan</div>
                    </div>
                    <select class="form-control dental-plan-select" name="dental_plan">
                        <option>Waived</option>
                        @if(isset($dentalPlans))
                        @foreach($dentalPlans as $dentalPlan)
                        <option {{ isset($employee) ? ($employee->dentalPlanInsuranceCoverage->isNotEmpty() ? ($employee->dentalPlanInsuranceCoverage[0]->dental_plan_id == $dentalPlan->id ? 'selected' : '') : '') : (old('dental_plan') == $dentalPlan->id ? 'selected' : '') }} value="{{$dentalPlan->id}}">{{$dentalPlan->description}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('dental_plan') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="dental_coverage_type">Coverage Type</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-info prevent-print">*</span>&nbsp;Coverage Type</div>
                    </div>
                    @if(isset($dentalPlans))
                    @foreach($dentalPlans as $dentalPlan)
                    <select class="form-control dental-coverage-types {{ isset($employee) ? ($employee->dentalPlanInsuranceCoverage->isNotEmpty() ? ($employee->dentalPlanInsuranceCoverage[0]->dental_plan_id == $dentalPlan->id ? '' : 'd-none') : 'd-none') : 'd-none' }}" id="dental-coverage-{{$dentalPlan->id}}" name="dental_coverage_type[{{$loop->index}}]">
                        <option></option>
                        @foreach($dentalPlan->insuranceCoverage as $insuranceCoverage)
                        <option class="dental-coverage-option" {{ isset($employee) ? ($employee->dentalPlanInsuranceCoverage->isNotEmpty() ? ($employee->dentalPlanInsuranceCoverage[0]->id == $insuranceCoverage->pivot->id ? 'selected' : '') : '') : (old('dental_coverage_type') == $insuranceCoverage->pivot->id ? 'selected' : '') }} value="{{$insuranceCoverage->pivot->id}}">{{$insuranceCoverage->description}} &nbsp ${{$insuranceCoverage->pivot->amount}}</option>
                        @endforeach
                        
                        
                    </select>
                    @endforeach
                    @endif
                </div>
                <small class="text-danger">{{ $errors->first('dental_coverage_type') }}</small>
            </div>

        </div> <!-- end form row -->
