        <h5 class="alert alert-info mt-5 toggle-section" id="employee-phone-number">Phone Numbers</h5>


@if(isset($employee))
@foreach($employee->phoneNumber as $phoneNumber)
        <div class="print-section form-row align-items-center employee-phone-number {{ $errors->has('phone_number.*.*') ? '' : 'd-none' }}">

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="phone_number[{{$loop->index}}][update]">Add Phone Number</label>
                <div class="input-group border border-secondary {{ isset($phoneNumber->id) ? 'bg-success text-white' : 'bg-warning text-dark' }} toggle-phone-number-{{$loop->index}}-div">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Add Phone Number</div>
                    </div>
                    <div class="form-check form-check-inline ml-4">
                        <input class="form-check-input toggle-add-item" id="toggle-phone-number-{{$loop->index}}" type="checkbox" name="phone_number[{{$loop->index}}][update]" value="1" {{isset($phoneNumber->id) ? 'checked' : (old('phone_number.'.$loop->index.'.update') == '1' ? 'checked' : '') }}>
                        <label class="form-check-label">Check to Add This Phone Number</label>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 my-1 d-none">
                <label class="sr-only" for="phone_number[{{$loop->index}}][id]">ID</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;ID</div>
                    </div>
                    <input type="text" class="form-control" name="phone_number[{{$loop->index}}][id]"  value="{{$phoneNumber->id}}">
                </div>
            </div>

            <div class="col-xl-4 my-1 toggle-phone-number-{{$loop->index}} {{ isset($phoneNumber->id) ? '' : 'd-none' }}">
                <label class="sr-only" for="phone_number[{{$loop->index}}][number]">Number</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Number</div>
                    </div>
                    <input type="text" class="form-control phone-number-format" maxlength="12" name="phone_number[{{$loop->index}}][number]"  value="{{ isset($phoneNumber->number) ? $phoneNumber->number : old('phone_number.'.$loop->index.'.number') }}">
                </div>
                <small class="text-danger">{{ $errors->first('phone_number.'.$loop->index.'.number') }}</small>
            </div>

            <input class="form-check-input phone-number-{{$loop->index}} phone-number-primary-checkbox d-none"  type="checkbox" name="phone_number[{{$loop->index}}][is_primary]" value="1" {{ $phoneNumber->is_primary == '1' ? 'checked' : '' }}>
            <button type="button" class="toggle-phone-number-{{$loop->index}} {{ isset($phoneNumber->id) ? '' : 'd-none' }} ml-1 mt-1 phone-number-primary-button btn {{$phoneNumber->is_primary == '1' ? 'btn-primary' : 'btn-outline-secondary'}}" id="phone-number-{{$loop->index}}">Primary</button>
            

        </div> <!-- end form row -->

        <hr class="print-section half-rule employee-phone-number mt-4 mb-4 {{ $errors->has('phone_number.*.*') ? '' : 'd-none' }}"/>
@endforeach
@endif



<!-- Sets the count for the remaining phone numbers -->
@if(isset($employee))
    @php ($i = $employee->phone_number_count) @endphp
@else
@php ($i = 0) @endphp
@endif

@for($i; $i <= 3; $i++)
        <div class="print-section form-row align-items-center employee-phone-number {{ $errors->has('phone_number.*.*') ? '' : 'd-none' }}">


            <div class="col-xl-4 my-1">
                <label class="sr-only" for="phone_number[{{$i}}][update]">Add Phone Number</label>
                <div class="input-group border border-secondary bg-warning text-dark toggle-phone-number-{{$i}}-div">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Add Phone Number</div>
                    </div>
                    <div class="form-check form-check-inline ml-4">
                        <input class="form-check-input toggle-add-item" id="toggle-phone-number-{{$i}}" type="checkbox" name="phone_number[{{$i}}][update]" value="1" {{ old('phone_number.'.$i.'.update') == '1' ? 'checked' : '' }}>
                        <label class="form-check-label">Check to Add This Phone Number</label>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 my-1 toggle-phone-number-{{$i}} d-none">
                <label class="sr-only" for="phone_number[{{$i}}][number]">Number</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Number</div>
                    </div>
                    <input type="text" class="form-control phone-number-format" maxlength="12" name="phone_number[{{$i}}][number]"  value="{{ old('phone_number.'.$i.'.number') }}">
                </div>
                <small class="text-danger">{{ $errors->first('phone_number.'.$i.'.number') }}</small>
            </div>

            <input class="form-check-input phone-number-{{$i}} phone-number-primary-checkbox d-none"  type="checkbox" name="phone_number[{{$i}}][is_primary]" value="1">
            <button type="button" class="ml-1 mt-1 phone-number-primary-button btn btn-outline-secondary toggle-phone-number-{{$i}} d-none" id="phone-number-{{$i}}">Primary</button>
            

        </div> <!-- end form row -->

        <hr class="print-section half-rule employee-phone-number mt-4 mb-4 {{ $errors->has('phone_number.*.*') ? '' : 'd-none' }}"/>
@endfor