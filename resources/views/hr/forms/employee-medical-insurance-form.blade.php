
        <h5 class="alert alert-info mt-5 toggle-section" id="employee-medical-insurance">Medical Insurance</h5>
        <div class="form-row align-items-center employee-medical-insurance {{ $errors->has('vitality_incentive') ? '' : 'd-none' }}">
        
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="medical_plan">Medical Plan</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Medical Plan</div>
                    </div>
                    <select class="form-control medical-plan-select" name="medical_plan">
                        <option>Waived</option>
                        @if(isset($medicalPlans))
                        @foreach($medicalPlans as $medicalPlan)
                        <option {{ isset($employee) ? ($employee->insuranceCoverageMedicalPlan->isNotEmpty() ? ($employee->insuranceCoverageMedicalPlan[0]->medical_plan_id == $medicalPlan->id ? 'selected' : '') : '') : (old('medical_plan') == $medicalPlan->id ? 'selected' : '') }} value="{{$medicalPlan->id}}">{{$medicalPlan->description}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('medical_plan') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="medical_coverage_type">Coverage Type</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Coverage Type</div>
                    </div>
                    @if(isset($medicalPlans))
                    @foreach($medicalPlans as $medicalPlan)
                    <select class="form-control medical-coverage-types {{ isset($employee) ? ($employee->insuranceCoverageMedicalPlan->isNotEmpty() ? ($employee->insuranceCoverageMedicalPlan[0]->medical_plan_id == $medicalPlan->id ? '' : 'd-none') : 'd-none') : 'd-none' }}" id="medical-coverage-{{$medicalPlan->id}}" name="medical_coverage_type[{{$loop->index}}]">
                        <option></option>
                        @foreach($medicalPlan->insuranceCoverage as $insuranceCoverage)
                        <option class="medical-coverage-option" {{ isset($employee) ? ($employee->insuranceCoverageMedicalPlan->isNotEmpty() ? ($employee->insuranceCoverageMedicalPlan[0]->id == $insuranceCoverage->pivot->id ? 'selected' : '') : '') : (old('medical_coverage_type') == $insuranceCoverage->pivot->id ? 'selected' : '') }} value="{{$insuranceCoverage->pivot->id}}">{{$insuranceCoverage->description}} &nbsp ${{$insuranceCoverage->pivot->amount}}</option>
                        @endforeach
                        
                        
                    </select>
                    @endforeach
                    @endif
                </div>
                <small class="text-danger">{{ $errors->first('medical_coverage_type') }}</small>
            </div>

        </div> <!-- end form row -->
