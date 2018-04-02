
        <h5 class="alert alert-info mt-5 toggle-section" id="employee-life-insurance">Life Insurance</h5>
        <div class="print-section form-row align-items-center employee-life-insurance d-none">
        
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="employee_optional_life">Employee Optional Life</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Employee Optional Life</div>
                    </div>
                    <select class="form-control" name="employee_optional_life">
                        <option>Waived</option>
                        <option {{ isset($employee) ? ($employee->employee_optional_life == '1' ? 'selected' : '') : '' }} value="1">1x Base Pay</option>
                        <option {{ isset($employee) ? ($employee->employee_optional_life == '2' ? 'selected' : '') : '' }} value="2">2x Base Pay</option>
                        <option {{ isset($employee) ? ($employee->employee_optional_life == '3' ? 'selected' : '') : '' }} value="3">3x Base Pay</option>
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('employee_optional_life') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="spouse_optional_life">Spouse Optional Life</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Spouse Optional Life</div>
                    </div>
                    <input type="text" class="form-control" name="spouse_optional_life" value="{{ isset($employee->spouse_optional_life) ? $employee->spouse_optional_life : old('spouse_optional_life') }}" placeholder="$0.00">
                </div>
                <small class="text-danger">{{ $errors->first('spouse_optional_life') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="dependant_optional_life">Dependant Optional Life</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Dependant Optional Life</div>
                    </div>
                    <input type="text" class="form-control" name="dependant_optional_life" value="{{ isset($employee->dependant_optional_life) ? $employee->dependant_optional_life : old('dependant_optional_life') }}" placeholder="$0.00">
                </div>
                <small class="text-danger">{{ $errors->first('dependant_optional_life') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="accidental_insurance">Accidental Insurance</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Accidental Insurance</div>
                    </div>
                    <input type="text" class="form-control" name="accidental_insurance_amount" value="{{ isset($employee) ? ($employee->accidentalCoverage->isNotEmpty() ? ($employee->accidentalCoverage[0]->pivot->amount) : '') : '' }}" placeholder="$0.00">
                    <select class="form-control" name="accidental_insurance_coverage">
                        <option value="">Waived</option>
                        @if(isset($accidentalCoverages))
                        @foreach($accidentalCoverages as $accidentalCoverage)
                        <option {{ isset($employee) ? ($employee->accidentalCoverage->isNotEmpty() ? ($employee->accidentalCoverage[0]->id == $accidentalCoverage->id ? 'selected' : '') : '') : '' }} value="{{$accidentalCoverage->id}}">{{$accidentalCoverage->description}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('accidental_insurance_amount') }} {{ $errors->first('accidental_insurance_coverage') }}</small>
            </div>

        </div> <!-- end form row -->

        <hr class="print-section half-rule employee-life-insurance mt-4 mb-4 d-none"/>

        

        @if(isset($employee))
        @foreach($employee->beneficiary as $beneficiary)
        <div class="print-section form-row align-items-center employee-life-insurance d-none">

            <div class="col-xl-4 my-1 d-none">
                <label class="sr-only" for="beneficiary[{{$loop->index}}][id]">ID</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">ID</div>
                    </div>
                    <input type="text" class="form-control" name="beneficiary[{{$loop->index}}][id]"  value="{{$beneficiary->id}}">
                </div>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="beneficiary[{{$loop->index}}]">Beneficiary</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Beneficiary</div>
                        <div class="input-group-text bg-primary beneficiary-div-{{$loop->index}}">
                            <input type="checkbox" class="beneficiary-checkbox" id="beneficiary-checkbox-{{$loop->index}}" name="beneficiary[{{$loop->index}}][update]" checked>
                        </div>
                    </div>
                    <input type="text" class="form-control" name="beneficiary[{{$loop->index}}][name]" value="{{$beneficiary->name}}" placeholder="Name">
                    <input type="text" class="form-control text-right beneficiary-{{$loop->index}} beneficiary-percentage" id="beneficiary-percentage-{{$loop->index}}" name="beneficiary[{{$loop->index}}][percentage]" value="{{$beneficiary->percentage}}" placeholder="Percentage">
                </div>
                <small class="text-danger">{{ $errors->first('beneficiary') }}</small>
            </div>

        </div> <!-- end form row -->
        @endforeach
        @endif

        <!-- Sets the count for the remaining beneficiaries -->
        @if(isset($employee))
            @php ($i = $employee->beneficiary_count) @endphp
        @else
        @php ($i = 0) @endphp
        @endif

        @for($i; $i <= 3; $i++)
        <div class="print-section form-row align-items-center employee-life-insurance d-none">

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="beneficiary[{{$i}}]">Beneficiary</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Beneficiary</div>
                        <div class="input-group-text beneficiary-div-{{$i}}">
                            <input type="checkbox" class="beneficiary-checkbox" id="beneficiary-checkbox-{{$i}}" name="beneficiary[{{$i}}][update]">
                        </div>
                    </div>
                    <input type="text" class="form-control" name="beneficiary[{{$i}}][name]" value="" placeholder="Name">
                    <input type="text" class="form-control text-right beneficiary-{{$i}} beneficiary-percentage" id="beneficiary-percentage-{{$i}}" name="beneficiary[{{$i}}][percentage]" value="" placeholder="Percentage">
                </div>
                <small class="text-danger">{{ $errors->first('beneficiary') }}</small>
            </div>

        </div> <!-- end form row -->
        @endfor

        <div class="print-section form-row align-items-center employee-life-insurance d-none">

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="beneficiary_total">Total Percentage</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Total Percentage</div>
                    </div>
                    <input type="text" class="form-control text-right" id="beneficiary-total" name="beneficiary_total" value="">
                </div>
            </div>

        </div> <!-- end form row -->