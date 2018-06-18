        <h5 class="alert alert-info mt-5 toggle-section" id="employee-emergency-contact">Emergency Contacts</h5>


@if(isset($employee))
@foreach($employee->emergencyContact as $emergencyContact)
        <div class="print-section form-row align-items-center employee-emergency-contact {{ $errors->has('emergency_contact.*.*') ? '' : 'd-none' }}">

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="emergency_contact[{{$loop->index}}][update]">Add Emergency Contact</label>
                <div class="input-group border border-secondary {{ isset($emergencyContact->id) ? 'bg-success text-white' : 'bg-warning text-dark' }} toggle-emergency-contact-{{$loop->index}}-div">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Add Emergency Contact</div>
                    </div>
                    <div class="form-check form-check-inline ml-4">
                        <input class="form-check-input toggle-add-item" id="toggle-emergency-contact-{{$loop->index}}" type="checkbox" name="emergency_contact[{{$loop->index}}][update]" value="1" {{isset($emergencyContact->id) ? 'checked' : (old('emergency_contact.'.$loop->index.'.update') == '1' ? 'checked' : '') }}>
                        <label class="form-check-label">Check to Add This Emergency Contact</label>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 my-1 d-none">
                <label class="sr-only" for="emergency_contact[{{$loop->index}}][id]">ID</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;ID</div>
                    </div>
                    <input type="text" class="form-control" name="emergency_contact[{{$loop->index}}][id]"  value="{{$emergencyContact->id}}">
                </div>
            </div>

            <div class="col-xl-4 my-1 toggle-emergency-contact-{{$loop->index}} {{ isset($emergencyContact->id) ? '' : 'd-none' }}">
                <label class="sr-only" for="emergency_contact[{{$loop->index}}][name]">Name</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Name</div>
                    </div>
                    <input type="text" class="form-control" name="emergency_contact[{{$loop->index}}][name]"  value="{{ isset($emergencyContact->name) ? $emergencyContact->name : old('emergency_contact.'.$loop->index.'.name') }}">
                </div>
                <small class="text-danger">{{ $errors->first('emergency_contact.'.$loop->index.'.name') }}</small>
            </div>

            <div class="col-xl-4 my-1 toggle-emergency-contact-{{$loop->index}} {{ isset($emergencyContact->id) ? '' : 'd-none' }}">
                <label class="sr-only" for="emergency_contact[{{$loop->index}}][number]">Number</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Number</div>
                    </div>
                    <input type="text" class="form-control phone-number-format" maxlength="12" name="emergency_contact[{{$loop->index}}][number]"  value="{{ isset($emergencyContact->number) ? $emergencyContact->number : old('emergency_contact.'.$loop->index.'.number') }}">
                </div>
                <small class="text-danger">{{ $errors->first('emergency_contact.'.$loop->index.'.number') }}</small>
            </div>

            <input class="form-check-input emergency-contact-{{$loop->index}} emergency-contact-primary-checkbox d-none"  type="checkbox" name="emergency_contact[{{$loop->index}}][is_primary]" value="1" {{ $emergencyContact->is_primary == '1' ? 'checked' : '' }}>
            <button type="button" class="toggle-emergency-contact-{{$loop->index}} {{ isset($emergencyContact->id) ? '' : 'd-none' }} ml-1 mt-1 emergency-contact-primary-button btn {{$emergencyContact->is_primary == '1' ? 'btn-primary' : 'btn-outline-secondary'}}" id="emergency-contact-{{$loop->index}}">Primary</button>


        </div> <!-- end form row -->

        <hr class="print-section half-rule employee-emergency-contact mt-4 mb-4 {{ $errors->has('emergency_contact.*.*') ? '' : 'd-none' }}"/>
@endforeach
@endif



<!-- Sets the count for the remaining emergency contacts -->
@if(isset($employee))
    @php ($i = $employee->emergency_contact_count) @endphp
@else
@php ($i = 0) @endphp
@endif

@for($i; $i <= 3; $i++)
        <div class="print-section form-row align-items-center employee-emergency-contact {{ $errors->has('emergency_contact.*.*') ? '' : 'd-none' }}">


            <div class="col-xl-4 my-1">
                <label class="sr-only" for="emergency_contact[{{$i}}][update]">Add Emergency Contact</label>
                <div class="input-group border border-secondary bg-warning text-dark toggle-emergency-contact-{{$i}}-div">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Add Emergency Contact</div>
                    </div>
                    <div class="form-check form-check-inline ml-4">
                        <input class="form-check-input toggle-add-item" id="toggle-emergency-contact-{{$i}}" type="checkbox" name="emergency_contact[{{$i}}][update]" value="1" {{ old('emergency_contact.'.$i.'.update') == '1' ? 'checked' : '' }}>
                        <label class="form-check-label">Check to Add This Emergency Contact</label>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 my-1 toggle-emergency-contact-{{$i}} d-none">
                <label class="sr-only" for="emergency_contact[{{$i}}][name]">Name</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Name</div>
                    </div>
                    <input type="text" class="form-control" name="emergency_contact[{{$i}}][name]"  value="{{ old('emergency_contact.'.$i.'.name') }}">
                </div>
                <small class="text-danger">{{ $errors->first('emergency_contact.'.$i.'.name') }}</small>
            </div>

            <div class="col-xl-4 my-1 toggle-emergency-contact-{{$i}} d-none">
                <label class="sr-only" for="emergency_contact[{{$i}}][number]">Number</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Number</div>
                    </div>
                    <input type="text" class="form-control phone-number-format" maxlength="12" name="emergency_contact[{{$i}}][number]"  value="{{ old('emergency_contact.'.$i.'.number') }}">
                </div>
                <small class="text-danger">{{ $errors->first('emergency_contact.'.$i.'.number') }}</small>
            </div>

            <input class="form-check-input emergency-contact-{{$i}} emergency-contact-primary-checkbox d-none"  type="checkbox" name="emergency_contact[{{$i}}][is_primary]" value="1" {{ old('emergency_contact.'.$i.'.is_primary') == '1' ? 'checked' : '' }}>
            <button type="button" class="ml-1 mt-1 emergency-contact-primary-button btn toggle-emergency-contact-{{$i}} d-none {{ old('emergency_contact.'.$i.'.is_primary') == '1' ? 'btn-primary' : 'btn-outline-secondary' }}" id="emergency-contact-{{$i}}">Primary</button>


        </div> <!-- end form row -->

        <hr class="print-section half-rule employee-emergency-contact mt-4 mb-4 {{ $errors->has('emergency_contact.*.*') ? '' : 'd-none' }}"/>
@endfor
