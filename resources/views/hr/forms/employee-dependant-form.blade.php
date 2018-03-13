        <h5 class="alert alert-info mt-5 toggle-section" id="employee-dependant">Dependants</h5>


@if(isset($employee))
@foreach($employee->dependant as $dependant)
        <div class="form-row align-items-center employee-dependant {{ $errors->has('dependant.*.*') ? '' : 'd-none' }}">

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="dependant[{{$loop->index}}][update]">Add Dependant</label>
                <div class="input-group border border-secondary {{ isset($dependant->id) ? 'bg-success text-white' : 'bg-warning text-dark' }} toggle-dependant-{{$loop->index}}-div">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Add Dependant</div>
                    </div>
                    <div class="form-check form-check-inline ml-4">
                        <input class="form-check-input toggle-add-item" id="toggle-dependant-{{$loop->index}}" type="checkbox" name="dependant[{{$loop->index}}][update]" value="1" {{isset($dependant->id) ? 'checked' : (old('dependant.'.$loop->index.'.update') == '1' ? 'checked' : '') }}>
                        <label class="form-check-label">Check to Add This Spouse</label>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 my-1 d-none">
                <label class="sr-only" for="dependant[{{$loop->index}}][id]">ID</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;ID</div>
                    </div>
                    <input type="text" class="form-control" name="dependant[{{$loop->index}}][id]"  value="{{$dependant->id}}">
                </div>
            </div>

            <div class="col-xl-4 my-1 toggle-dependant-{{$loop->index}} {{ isset($dependant->id) ? '' : 'd-none' }}">
                <label class="sr-only" for="dependant[$loop->index][first_name]">First Name</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;First Name</div>
                    </div>
                    <input type="text" class="form-control" name="dependant[$loop->index][first_name]"  value="{{ isset($dependant->first_name) ? $dependant->first_name : old('dependant.'.$loop->index.'.first_name') }}">
                </div>
                <small class="text-danger">{{ $errors->first('dependant.'.$loop->index.'.first_name') }}</small>
            </div>

            <div class="col-xl-4 my-1 toggle-dependant-{{$loop->index}} {{ isset($dependant->id) ? '' : 'd-none' }}">
                <label class="sr-only" for="dependant[$loop->index][last_name]">Last Name</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Last Name</div>
                    </div>
                    <input type="text" class="form-control" name="dependant[$loop->index][last_name]"  value="{{ isset($dependant->last_name) ? $dependant->last_name : old('dependant.'.$loop->index.'.last_name') }}">
                </div>
                <small class="text-danger">{{ $errors->first('dependant.'.$loop->index.'.last_name') }}</small>
            </div>

            <div class="col-xl-4 my-1 toggle-dependant-{{$loop->index}} {{ isset($dependant->id) ? '' : 'd-none' }}">
                <label class="sr-only" for="dependant[$loop->index][middle_initial]">Middle Initial</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Middle Initial</div>
                    </div>
                    <input type="text" class="form-control" name="dependant[$loop->index][middle_initial]" value="{{ isset($dependant->middle_initial) ? $dependant->middle_initial : old('dependant.'.$loop->index.'.middle_initial') }}">
                </div>
                <small class="text-danger">{{ $errors->first('dependant.'.$loop->index.'.middle_initial') }}</small>
            </div>

            <div class="col-xl-4 my-1 toggle-dependant-{{$loop->index}} {{ isset($dependant->id) ? '' : 'd-none' }}">
                <label class="sr-only" for="dependant[$loop->index][ssn]">SSN</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;SSN</div>
                    </div>
                    <input type="text" class="form-control ssn-format" name="dependant[$loop->index][ssn]"  maxlength="11" value="{{ isset($dependant->ssn) ? $dependant->ssn : old('dependant.'.$loop->index.'.ssn') }}">
                </div>
                <small class="text-danger">{{ $errors->first('dependant.'.$loop->index.'.ssn') }}</small>
            </div>

            <div class="col-xl-4 my-1 toggle-dependant-{{$loop->index}} {{ isset($dependant->id) ? '' : 'd-none' }}">
                <label class="sr-only" for="dependant[$loop->index][birth_date]">Birth Date</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Birth Date</div>
                    </div>
                    <input type="text" class="form-control ui-datepicker-prev date-pick" name="dependant[$loop->index][birth_date]"  value="{{ isset($dependant->birth_date) ? $dependant->birth_date->format('m-d-Y') : old('dependant.'.$loop->index.'.birth_date') }}">
                </div>
                <small class="text-danger">{{ $errors->first('dependant.'.$loop->index.'.birth_date') }}</small>
            </div>

            <div class="col-xl-4 my-1 toggle-dependant-{{$loop->index}} {{ isset($dependant->id) ? '' : 'd-none' }}">
                <label class="sr-only" for="dependant[$loop->index][gender]">Gender</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Gender</div>
                    </div>
                    <select class="form-control" name="dependant[$loop->index][gender]" >
                        <option></option>
                        <option {{ isset($dependant->gender) ? ($dependant->gender == 'male' ? 'selected' : '') : (old('dependant.'.$loop->index.'.gender') == 'male' ? 'selected' : '') }} value="male">Male</option>
                        <option {{ isset($dependant->gender) ? ($dependant->gender == 'female' ? 'selected' : '') : (old('dependant.'.$loop->index.'.gender') == 'female' ? 'selected' : '') }} value="female">Female</option>
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('dependant.'.$loop->index.'.gender') }}</small>
            </div>

        </div> <!-- end form row -->

        <hr class="half-rule employee-dependant mt-4 mb-4 {{ $errors->has('dependant.*.*') ? '' : 'd-none' }}"/>
@endforeach
@endif



<!-- Sets the count for the remaining dependants -->
@if(isset($employee))
    @php ($i = $employee->dependant_count) @endphp
@else
@php ($i = 0) @endphp
@endif

@for($i; $i <= 4; $i++)
        <div class="form-row align-items-center employee-dependant {{ $errors->has('dependant.*.*') ? '' : 'd-none' }}">


            <div class="col-xl-4 my-1">
                <label class="sr-only" for="dependant[{{$i}}][update]">Add Dependant</label>
                <div class="input-group border border-secondary bg-warning text-dark toggle-dependant-{{$i}}-div">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Add Dependant</div>
                    </div>
                    <div class="form-check form-check-inline ml-4">
                        <input class="form-check-input toggle-add-item" id="toggle-dependant-{{$i}}" type="checkbox" name="dependant[{{$i}}][update]" value="1" {{ old('dependant.'.$i.'.update') == '1' ? 'checked' : '' }}>
                        <label class="form-check-label">Check to Add This Spouse</label>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 my-1 toggle-dependant-{{$i}} d-none">
                <label class="sr-only" for="dependant[{{$i}}][first_name]">First Name</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;First Name</div>
                    </div>
                    <input type="text" class="form-control" name="dependant[{{$i}}][first_name]"  value="{{ old('dependant.'.$i.'.first_name') }}">
                </div>
                <small class="text-danger">{{ $errors->first('dependant.'.$i.'.first_name') }}</small>
            </div>

            <div class="col-xl-4 my-1 toggle-dependant-{{$i}} d-none">
                <label class="sr-only" for="dependant[{{$i}}][last_name]">Last Name</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Last Name</div>
                    </div>
                    <input type="text" class="form-control" name="dependant[{{$i}}][last_name]"  value="{{ old('dependant.'.$i.'.last_name') }}">
                </div>
                <small class="text-danger">{{ $errors->first('dependant.'.$i.'.last_name') }}</small>
            </div>

            <div class="col-xl-4 my-1 toggle-dependant-{{$i}} d-none">
                <label class="sr-only" for="dependant[{{$i}}][middle_initial]">Middle Initial</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Middle Initial</div>
                    </div>
                    <input type="text" class="form-control" name="dependant[{{$i}}][middle_initial]" value="{{ old('dependant.'.$i.'.middle_initial') }}">
                </div>
                <small class="text-danger">{{ $errors->first('dependant.'.$i.'.middle_initial') }}</small>
            </div>

            <div class="col-xl-4 my-1 toggle-dependant-{{$i}} d-none">
                <label class="sr-only" for="dependant[{{$i}}][ssn]">SSN</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;SSN</div>
                    </div>
                    <input type="text" class="form-control ssn-format" name="dependant[{{$i}}][ssn]"  maxlength="11" value="{{ old('dependant.'.$i.'.ssn') }}">
                </div>
                <small class="text-danger">{{ $errors->first('dependant.'.$i.'.ssn') }}</small>
            </div>

            <div class="col-xl-4 my-1 toggle-dependant-{{$i}} d-none">
                <label class="sr-only" for="dependant[{{$i}}][birth_date]">Birth Date</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Birth Date</div>
                    </div>
                    <input type="text" class="form-control ui-datepicker-prev date-pick" name="dependant[{{$i}}][birth_date]"  value="{{ old('dependant.'.$i.'.birth_date') }}">
                </div>
                <small class="text-danger">{{ $errors->first('dependant.'.$i.'.birth_date') }}</small>
            </div>

            <div class="col-xl-4 my-1 toggle-dependant-{{$i}} d-none">
                <label class="sr-only" for="dependant[{{$i}}][gender]">Gender</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Gender</div>
                    </div>
                    <select class="form-control" name="dependant[{{$i}}][gender]" >
                        <option></option>
                        <option {{ old('dependant.'.$i.'.gender') == 'male' ? 'selected' : '' }} value="male">Male</option>
                        <option {{ old('dependant.'.$i.'.gender') == 'female' ? 'selected' : '' }} value="female">Female</option>
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('dependant.'.$i.'.gender') }}</small>
            </div>

        </div> <!-- end form row -->

        <hr class="half-rule employee-dependant mt-4 mb-4 {{ $errors->has('dependant.*.*') ? '' : 'd-none' }}"/>
@endfor