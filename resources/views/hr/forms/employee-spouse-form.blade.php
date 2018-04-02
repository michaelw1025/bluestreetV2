
        <h5 class="alert alert-info mt-5 toggle-section" id="employee-spouse">Spouse</h5>
        <div class="print-section form-row align-items-center employee-spouse {{ $errors->has('spouse.*.*') ? '' : 'd-none' }}">
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="spouse[0][update]">Add Spouse</label>
                <div class="input-group border border-secondary {{ isset($employee->spouse->id) ? 'bg-success text-white' : 'bg-warning text-dark' }} toggle-spouse-0-div">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Add Spouse</div>
                    </div>
                    <div class="form-check form-check-inline ml-4">
                    <!-- <input type="hidden" name="spouse[0][update]" value="0"> -->
                        <input class="form-check-input toggle-add-item" id="toggle-spouse-0" type="checkbox" name="spouse[0][update]" value="1" {{ isset($employee->spouse->id) ? 'checked' : (old('spouse.0.update') == '1' ? 'checked' : '') }}>
                        <label class="form-check-label">Check To Add This Spouse</label>
                    </div>
                </div>
            </div>
            @if(isset($employee->spouse->id))
            <div class="col-xl-4 my-1 d-none">
                <label class="sr-only" for="spouse[0][id]">ID</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;ID</div>
                    </div>
                    <input type="text" class="form-control" name="spouse[0][id]"  value="{{ isset($employee->spouse->id) ? $employee->spouse->id : '' }}">
                </div>
            </div>
            @endif
            <div class="col-xl-4 my-1 toggle-spouse-0 {{ isset($employee->spouse->id) ? '' : 'd-none' }}">
                <label class="sr-only" for="spouse[0][first_name]">First Name</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;First Name</div>
                    </div>
                    <input type="text" class="form-control" name="spouse[0][first_name]"  value="{{ isset($employee->spouse->first_name) ? $employee->spouse->first_name : old('spouse.0.first_name') }}">
                </div>
                <small class="text-danger">{{ $errors->first('spouse.0.first_name') }}</small>
            </div>
            <div class="col-xl-4 my-1 toggle-spouse-0 {{ isset($employee->spouse->id) ? '' : 'd-none' }}">
                <label class="sr-only" for="spouse[0][last_name]">Last Name</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Last Name</div>
                    </div>
                    <input type="text" class="form-control" name="spouse[0][last_name]"  value="{{ isset($employee->spouse->last_name) ? $employee->spouse->last_name : old('spouse.0.last_name') }}">
                </div>
                <small class="text-danger">{{ $errors->first('spouse.0.last_name') }}</small>
            </div>
            <div class="col-xl-4 my-1 toggle-spouse-0 {{ isset($employee->spouse->id) ? '' : 'd-none' }}">
                <label class="sr-only" for="spouse[0][middle_initial]">Middle Initial</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Middle Initial</div>
                    </div>
                    <input type="text" class="form-control" name="spouse[0][middle_initial]" value="{{ isset($employee->spouse->middle_initial) ? $employee->spouse->middle_initial : old('spouse.0.middle_initial') }}">
                </div>
                <small class="text-danger">{{ $errors->first('spouse.0.middle_initial') }}</small>
            </div>
            <div class="col-xl-4 my-1 toggle-spouse-0 {{ isset($employee->spouse->id) ? '' : 'd-none' }}">
                <label class="sr-only" for="spouse[0][ssn]">SSN</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;SSN</div>
                    </div>
                    <input type="text" class="form-control ssn-format" name="spouse[0][ssn]"  maxlength="11" value="{{ isset($employee->spouse->ssn) ? $employee->spouse->ssn : old('spouse.0.ssn') }}">
                </div>
                <small class="text-danger">{{ $errors->first('spouse.0.ssn') }}</small>
            </div>
            <div class="col-xl-4 my-1 toggle-spouse-0 {{ isset($employee->spouse->id) ? '' : 'd-none' }}">
                <label class="sr-only" for="spouse[0][birth_date]">Birth Date</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Birth Date</div>
                    </div>
                    <input type="text" class="form-control ui-datepicker-prev date-pick" name="spouse[0][birth_date]"  value="{{ isset($employee->spouse->birth_date) ? $employee->spouse->birth_date->format('m-d-Y') : old('spouse.0.birth_date') }}">
                </div>
                <small class="text-danger">{{ $errors->first('spouse.0.birth_date') }}</small>
            </div>
            <div class="col-xl-4 my-1 toggle-spouse-0 {{ isset($employee->spouse->id) ? '' : 'd-none' }}">
                <label class="sr-only" for="spouse[0][gender]">Gender</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Gender</div>
                    </div>
                    <select class="form-control" name="spouse[0][gender]" >
                        <option></option>
                        <option {{ isset($employee->spouse->gender) ? ($employee->spouse->gender == 'male' ? 'selected' : '') : (old('spouse.0.gender') == 'male' ? 'selected' : '') }} value="male">Male</option>
                        <option {{ isset($employee->spouse->gender) ? ($employee->spouse->gender == 'female' ? 'selected' : '') : (old('spouse.0.gender') == 'female' ? 'selected' : '') }} value="female">Female</option>
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('spouse.0.gender') }}</small>
            </div>
            <div class="col-xl-4 my-1 toggle-spouse-0 {{ isset($employee->spouse->id) ? '' : 'd-none' }}">
                <label class="sr-only" for="spouse[0][domestic_partner]">Domestic Partner</label>
                <div class="input-group border border-dark">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Domestic Partner</div>
                    </div>
                    <div class="form-check form-check-inline ml-4">
                        <input class="form-check-input" type="radio" name="spouse[0][domestic_partner]" value="1" {{ isset($employee->spouse->domestic_partner) ? ($employee->spouse->domestic_partner == '1' ? 'checked' : '') : (old('spouse.domestic_partner') == '' ? 'checked' : '') }}>
                        <label class="form-check-label">Yes</label>
                    </div>
                    <div class="form-check form-check-inline ml-4">
                        <input class="form-check-input" type="radio" name="spouse[0][domestic_partner]" value="0" {{ isset($employee->spouse->domestic_partner) ? ($employee->spouse->domestic_partner == '0' ? 'checked' : '') : (old('spousespouse.domestic_partner') == '' ? 'checked' : '') }}>
                        <label class="form-check-label">No</label>
                    </div>
                </div>
                <small class="text-danger">{{ $errors->first('spouse.domestic_partner') }}</small>
            </div>
        </div> <!-- end form row -->
