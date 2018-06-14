
        <div class="form-row align-items-center">
            @if(isset($employee))
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="id">Employee ID</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Employee ID</div>
                    </div>
                    <input type="text" class="form-control" name="id" value="{{ isset($employee->id) ? $employee->id : '' }}" disabled>
                </div>
            </div>
            @endif

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="first_name">First Name</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;First Name</div>
                    </div>
                    <input type="text" class="form-control" name="first_name" required value="{{ isset($employee->first_name) ? $employee->first_name : old('first_name') }}">
                </div>
                <small class="text-danger">{{ $errors->first('first_name') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="last_name">Last Name</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Last Name</div>
                    </div>
                    <input type="text" class="form-control" name="last_name" required value="{{ isset($employee->last_name) ? $employee->last_name : old('last_name') }}">
                </div>
                <small class="text-danger">{{ $errors->first('last_name') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="middle_initial">Middle Initial</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Middle Initial</div>
                    </div>
                    <input type="text" class="form-control" name="middle_initial" value="{{ isset($employee->middle_initial) ? $employee->middle_initial : old('middle_initial') }}">
                </div>
                <small class="text-danger">{{ $errors->first('middle_initial') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="ssn">SSN</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;SSN</div>
                    </div>
                    <input type="text" class="form-control ssn-format" name="ssn" required maxlength="11" value="{{ isset($employee->ssn) ? $employee->ssn : old('ssn') }}">
                </div>
                <small class="text-danger">{{ $errors->first('ssn') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="oracle_number">Oracle Number</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Oracle Number</div>
                    </div>
                    <input type="text" class="form-control" name="oracle_number" maxlength="6" value="{{ isset($employee->oracle_number) ? $employee->oracle_number : old('oracle_number') }}">
                </div>
                <small class="text-danger">{{ $errors->first('oracle_number') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="birth_date">Birth Date</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Birth Date</div>
                    </div>
                    <input type="text" class="form-control ui-datepicker-prev date-pick" name="birth_date" required value="{{ isset($employee->birth_date) ? $employee->birth_date->format('m-d-Y') : old('birth_date') }}">
                </div>
                <small class="text-danger">{{ $errors->first('birth_date') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="hire_date">Hire Date</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Hire Date</div>
                    </div>
                    <input type="text" class="form-control ui-datepicker-prev date-pick" name="hire_date" required value="{{ isset($employee->hire_date) ? $employee->hire_date->format('m-d-Y') : old('hire_date') }}">
                </div>
                <small class="text-danger">{{ $errors->first('hire_date') }}</small>
            </div>

            @if(isset($employee))
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="service_date">Service Date</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Service Date</div>
                    </div>
                    <input type="text" class="form-control ui-datepicker-prev date-pick" name="service_date" required value="{{ isset($employee->service_date) ? $employee->service_date->format('m-d-Y') : old('service_date') }}">
                </div>
                <small class="text-danger">{{ $errors->first('service_date') }}</small>
            </div>
            @endif

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="maiden_name">Maiden Name</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Maiden Name</div>
                    </div>
                    <input type="text" class="form-control" name="maiden_name" value="{{ isset($employee->maiden_name) ? $employee->maiden_name : old('maiden_name') }}">
                </div>
                <small class="text-danger">{{ $errors->first('maiden_name') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="nick_name">Nick Name</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Nick Name</div>
                    </div>
                    <input type="text" class="form-control" name="nick_name" value="{{ isset($employee->nick_name) ? $employee->nick_name : old('nick_name') }}">
                </div>
                <small class="text-danger">{{ $errors->first('nick_name') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="gender">Gender</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Gender</div>
                    </div>
                    <select class="form-control" name="gender" required>
                        <option></option>
                        <option {{ isset($employee) ? ($employee->gender == 'male' ? 'selected' : '') : (old('gender') == 'male' ? 'selected' : '') }} value="male">Male</option>
                        <option {{ isset($employee) ? ($employee->gender == 'female' ? 'selected' : '') : (old('gender') == 'female' ? 'selected' : '') }} value="female">Female</option>
                        <option {{ isset($employee) ? ($employee->gender == 'none' ? 'selected' : '') : (old('gender') == 'none' ? 'selected' : '') }} value="none">None</option>
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('gender') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="suffix">Suffix</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Suffix</div>
                    </div>
                    <select class="form-control" name="suffix">
                        <option></option>
                        <option {{ isset($employee) ? ($employee->suffix == 'mr' ? 'selected' : '') : '' }} value="mr">Mr</option>
                        <option {{ isset($employee) ? ($employee->suffix == 'mrs' ? 'selected' : '') : '' }} value="mrs">Mrs</option>
                        <option {{ isset($employee) ? ($employee->suffix == 'miss' ? 'selected' : '') : '' }} value="miss">Miss</option>
                        <option {{ isset($employee) ? ($employee->suffix == 'jr' ? 'selected' : '') : '' }} value="jr">Jr</option>
                        <option {{ isset($employee) ? ($employee->suffix == 'sr' ? 'selected' : '') : '' }} value="sr">Sr</option>
                        <option {{ isset($employee) ? ($employee->suffix == 'ii' ? 'selected' : '') : '' }} value="ii">II</option>
                        <option {{ isset($employee) ? ($employee->suffix == 'iii' ? 'selected' : '') : '' }} value="iii">III</option>
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('suffix') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="address_1">Address</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Address</div>
                    </div>
                    <input type="text" class="form-control" name="address_1" required value="{{ isset($employee->address_1) ? $employee->address_1 : old('address_1') }}">
                </div>
                <small class="text-danger">{{ $errors->first('address_1') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="address_2">Address Cont</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Address Cont</div>
                    </div>
                    <input type="text" class="form-control" name="address_2" value="{{ isset($employee->address_2) ? $employee->address_2 : old('address_2') }}">
                </div>
                <small class="text-danger">{{ $errors->first('address_2') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="city">City</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;City</div>
                    </div>
                    <input type="text" class="form-control" name="city" required value="{{ isset($employee->city) ? $employee->city : old('city') }}">
                </div>
                <small class="text-danger">{{ $errors->first('city') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="state">State</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;State</div>
                    </div>
                    <select class="form-control" name="state" required>
                        <option></option>
                        <option value="AL" {{ isset($employee->state) ? ($employee->state == 'AL' ? 'selected' : '') : (old('state') == 'AL' ? 'selected' : '') }}>Alabama</option>
                        <option value="AK" {{ isset($employee->state) ? ($employee->state == 'AK' ? 'selected' : '') : (old('state') == 'AK' ? 'selected' : '') }}>Alaska</option>
                        <option value="AZ" {{ isset($employee->state) ? ($employee->state == 'AZ' ? 'selected' : '') : (old('state') == 'AZ' ? 'selected' : '') }}>Arizona</option>
                        <option value="AR" {{ isset($employee->state) ? ($employee->state == 'AR' ? 'selected' : '') : (old('state') == 'AR' ? 'selected' : '') }}>Arkansas</option>
                        <option value="CA" {{ isset($employee->state) ? ($employee->state == 'CA' ? 'selected' : '') : (old('state') == 'CA' ? 'selected' : '') }}>California</option>
                        <option value="CO" {{ isset($employee->state) ? ($employee->state == 'CO' ? 'selected' : '') : (old('state') == 'CO' ? 'selected' : '') }}>Colorado</option>
                        <option value="CT" {{ isset($employee->state) ? ($employee->state == 'CT' ? 'selected' : '') : (old('state') == 'CT' ? 'selected' : '') }}>Connecticut</option>
                        <option value="DE" {{ isset($employee->state) ? ($employee->state == 'DE' ? 'selected' : '') : (old('state') == 'DE' ? 'selected' : '') }}>Delaware</option>
                        <option value="DC" {{ isset($employee->state) ? ($employee->state == 'DC' ? 'selected' : '') : (old('state') == 'DC' ? 'selected' : '') }}>District Of Columbia</option>
                        <option value="FL" {{ isset($employee->state) ? ($employee->state == 'FL' ? 'selected' : '') : (old('state') == 'FL' ? 'selected' : '') }}>Florida</option>
                        <option value="GA" {{ isset($employee->state) ? ($employee->state == 'GA' ? 'selected' : '') : (old('state') == 'GA' ? 'selected' : '') }}>Georgia</option>
                        <option value="HI" {{ isset($employee->state) ? ($employee->state == 'HI' ? 'selected' : '') : (old('state') == 'HI' ? 'selected' : '') }}>Hawaii</option>
                        <option value="ID" {{ isset($employee->state) ? ($employee->state == 'ID' ? 'selected' : '') : (old('state') == 'ID' ? 'selected' : '') }}>Idaho</option>
                        <option value="IL" {{ isset($employee->state) ? ($employee->state == 'IL' ? 'selected' : '') : (old('state') == 'IL' ? 'selected' : '') }}>Illinois</option>
                        <option value="IN" {{ isset($employee->state) ? ($employee->state == 'IN' ? 'selected' : '') : (old('state') == 'IN' ? 'selected' : '') }}>Indiana</option>
                        <option value="IA" {{ isset($employee->state) ? ($employee->state == 'IA' ? 'selected' : '') : (old('state') == 'IA' ? 'selected' : '') }}>Iowa</option>
                        <option value="KS" {{ isset($employee->state) ? ($employee->state == 'KS' ? 'selected' : '') : (old('state') == 'KS' ? 'selected' : '') }}>Kansas</option>
                        <option value="KY" {{ isset($employee->state) ? ($employee->state == 'KY' ? 'selected' : '') : (old('state') == 'KY' ? 'selected' : '') }}>Kentucky</option>
                        <option value="LA" {{ isset($employee->state) ? ($employee->state == 'LA' ? 'selected' : '') : (old('state') == 'LA' ? 'selected' : '') }}>Louisiana</option>
                        <option value="ME" {{ isset($employee->state) ? ($employee->state == 'ME' ? 'selected' : '') : (old('state') == 'ME' ? 'selected' : '') }}>Maine</option>
                        <option value="MD" {{ isset($employee->state) ? ($employee->state == 'MD' ? 'selected' : '') : (old('state') == 'MD' ? 'selected' : '') }}>Maryland</option>
                        <option value="MA" {{ isset($employee->state) ? ($employee->state == 'MA' ? 'selected' : '') : (old('state') == 'MA' ? 'selected' : '') }}>Massachusetts</option>
                        <option value="MI" {{ isset($employee->state) ? ($employee->state == 'MI' ? 'selected' : '') : (old('state') == 'MI' ? 'selected' : '') }}>Michigan</option>
                        <option value="MN" {{ isset($employee->state) ? ($employee->state == 'MN' ? 'selected' : '') : (old('state') == 'MN' ? 'selected' : '') }}>Minnesota</option>
                        <option value="MS" {{ isset($employee->state) ? ($employee->state == 'MS' ? 'selected' : '') : (old('state') == 'MS' ? 'selected' : '') }}>Mississippi</option>
                        <option value="MO" {{ isset($employee->state) ? ($employee->state == 'MO' ? 'selected' : '') : (old('state') == 'MO' ? 'selected' : '') }}>Missouri</option>
                        <option value="MT" {{ isset($employee->state) ? ($employee->state == 'MT' ? 'selected' : '') : (old('state') == 'MT' ? 'selected' : '') }}>Montana</option>
                        <option value="NE" {{ isset($employee->state) ? ($employee->state == 'NE' ? 'selected' : '') : (old('state') == 'NE' ? 'selected' : '') }}>Nebraska</option>
                        <option value="NV" {{ isset($employee->state) ? ($employee->state == 'NV' ? 'selected' : '') : (old('state') == 'NV' ? 'selected' : '') }}>Nevada</option>
                        <option value="NH" {{ isset($employee->state) ? ($employee->state == 'NH' ? 'selected' : '') : (old('state') == 'NH' ? 'selected' : '') }}>New Hampshire</option>
                        <option value="NJ" {{ isset($employee->state) ? ($employee->state == 'NJ' ? 'selected' : '') : (old('state') == 'NJ' ? 'selected' : '') }}>New Jersey</option>
                        <option value="NM" {{ isset($employee->state) ? ($employee->state == 'NM' ? 'selected' : '') : (old('state') == 'NM' ? 'selected' : '') }}>New Mexico</option>
                        <option value="NY" {{ isset($employee->state) ? ($employee->state == 'NY' ? 'selected' : '') : (old('state') == 'NY' ? 'selected' : '') }}>New York</option>
                        <option value="NC" {{ isset($employee->state) ? ($employee->state == 'NC' ? 'selected' : '') : (old('state') == 'NC' ? 'selected' : '') }}>North Carolina</option>
                        <option value="ND" {{ isset($employee->state) ? ($employee->state == 'ND' ? 'selected' : '') : (old('state') == 'ND' ? 'selected' : '') }}>North Dakota</option>
                        <option value="OH" {{ isset($employee->state) ? ($employee->state == 'OH' ? 'selected' : '') : (old('state') == 'OH' ? 'selected' : '') }}>Ohio</option>
                        <option value="OK" {{ isset($employee->state) ? ($employee->state == 'OK' ? 'selected' : '') : (old('state') == 'OK' ? 'selected' : '') }}>Oklahoma</option>
                        <option value="OR" {{ isset($employee->state) ? ($employee->state == 'OR' ? 'selected' : '') : (old('state') == 'OR' ? 'selected' : '') }}>Oregon</option>
                        <option value="PA" {{ isset($employee->state) ? ($employee->state == 'PA' ? 'selected' : '') : (old('state') == 'PA' ? 'selected' : '') }}>Pennsylvania</option>
                        <option value="RI" {{ isset($employee->state) ? ($employee->state == 'RI' ? 'selected' : '') : (old('state') == 'RI' ? 'selected' : '') }}>Rhode Island</option>
                        <option value="SC" {{ isset($employee->state) ? ($employee->state == 'SC' ? 'selected' : '') : (old('state') == 'SC' ? 'selected' : '') }}>South Carolina</option>
                        <option value="SD" {{ isset($employee->state) ? ($employee->state == 'SD' ? 'selected' : '') : (old('state') == 'SD' ? 'selected' : '') }}>South Dakota</option>
                        <option value="TN" {{ isset($employee->state) ? ($employee->state == 'TN' ? 'selected' : '') : (old('state') == 'TN' ? 'selected' : '') }}>Tennessee</option>
                        <option value="TX" {{ isset($employee->state) ? ($employee->state == 'TX' ? 'selected' : '') : (old('state') == 'TX' ? 'selected' : '') }}>Texas</option>
                        <option value="UT" {{ isset($employee->state) ? ($employee->state == 'UT' ? 'selected' : '') : (old('state') == 'UT' ? 'selected' : '') }}>Utah</option>
                        <option value="VT" {{ isset($employee->state) ? ($employee->state == 'VT' ? 'selected' : '') : (old('state') == 'VT' ? 'selected' : '') }}>Vermont</option>
                        <option value="VA" {{ isset($employee->state) ? ($employee->state == 'VA' ? 'selected' : '') : (old('state') == 'VA' ? 'selected' : '') }}>Virginia</option>
                        <option value="WA" {{ isset($employee->state) ? ($employee->state == 'WA' ? 'selected' : '') : (old('state') == 'WA' ? 'selected' : '') }}>Washington</option>
                        <option value="WV" {{ isset($employee->state) ? ($employee->state == 'WV' ? 'selected' : '') : (old('state') == 'WV' ? 'selected' : '') }}>West Virginia</option>
                        <option value="WI" {{ isset($employee->state) ? ($employee->state == 'WI' ? 'selected' : '') : (old('state') == 'WI' ? 'selected' : '') }}>Wisconsin</option>
                        <option value="WY" {{ isset($employee->state) ? ($employee->state == 'WY' ? 'selected' : '') : (old('state') == 'WY' ? 'selected' : '') }}>Wyoming</option>
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('state') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="zip_code">Zip Code</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Zip Code</div>
                    </div>
                    <input type="text" class="form-control" name="zip_code" required value="{{ isset($employee->zip_code) ? $employee->zip_code : old('zip_code') }}">
                </div>
                <small class="text-danger">{{ $errors->first('zip_code') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="county">County</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;County</div>
                    </div>
                    <input type="text" class="form-control" name="county" required value="{{ isset($employee->county) ? $employee->county : old('county') }}">
                </div>
                <small class="text-danger">{{ $errors->first('county') }}</small>
            </div>

            @if(isset($employee))

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="status">Status</label>
                <div class="input-group {{ $employee->status == '1' ? 'border border-success' : 'border border-danger' }}">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Status</div>
                    </div>
                    <div class="form-check form-check-inline ml-4">
                        <input class="form-check-input" type="radio" name="status" value="1" {{ $employee->status == '1' ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
                    </div>
                    <div class="form-check form-check-inline ml-4">
                        <input class="form-check-input" type="radio" name="status" value="0" {{ $employee->status == '0' ? 'checked' : '' }}>
                        <label class="form-check-label">Inactive</label>
                    </div>
                </div>
                <small class="text-danger">{{ $errors->first('status') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="rehire">Rehire Eligible</label>
                <div class="input-group {{ $employee->rehire == '1' ? 'border border-success' : 'border border-danger' }}">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Rehire Eligible</div>
                    </div>
                    <div class="form-check form-check-inline ml-4">
                        <input class="form-check-input" type="radio" name="rehire" value="1" {{ $employee->rehire == '1' ? 'checked' : '' }}>
                        <label class="form-check-label">Yes</label>
                    </div>
                    <div class="form-check form-check-inline ml-4">
                        <input class="form-check-input" type="radio" name="rehire" value="0" {{ $employee->rehire == '0' ? 'checked' : '' }}>
                        <label class="form-check-label">No</label>
                    </div>
                </div>
                <small class="text-danger">{{ $errors->first('rehire') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="reviews">Reviews</label>
                <div class="input-group border border-secondary">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Reviews</div>
                    </div>
                    <div class="form-check form-check-inline ml-4">
                        <input class="form-check-input" type="checkbox" name="thirty_day_review" value="1" {{ $employee->thirty_day_review == '1' ? 'checked' : '' }}>
                        <label class="form-check-label">30 Day</label>
                    </div>
                    <div class="form-check form-check-inline ml-4">
                        <input class="form-check-input" type="checkbox" name="sixty_day_review" value="1" {{ $employee->sixty_day_review == '1' ? 'checked' : '' }}>
                        <label class="form-check-label">60 Day</label>
                    </div>
                </div>
                <small class="text-danger">{{ $errors->first('reviews') }}</small>
            </div>

            @endif
            </div> <!-- end form row -->
