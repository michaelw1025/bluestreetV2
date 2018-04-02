
        <h5 class="alert alert-info mt-5 toggle-section" id="employee-parking-permit">Parking Permit</h5>
        <div class="print-section form-row align-items-center employee-parking-permit {{ $errors->has('parking_permit_number') ? '' : 'd-none' }}">
        
        <div class="col-xl-4 my-1">
                <label class="sr-only" for="parking_permit_number">Permit Number</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Permit Number</div>
                    </div>
                    <input type="text" class="form-control" name="parking_permit_number" value="{{ old('parking_permit_number') }}">
                </div>
                <small class="text-danger">{{ $errors->first('parking_permit_number') }}</small>
            </div>

            

        </div> <!-- end form row -->

        <hr class="print-section half-rule employee-parking-permit mt-4 mb-4 d-none"/>

        

        @if(isset($employee))
            @foreach($employee->parkingPermit as $parkingPermit)
            <div class="print-section form-row align-items-center employee-parking-permit {{ $errors->has('parking_permit_number') ? '' : 'd-none' }}">
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="parking_permit_number_{{$parkingPermit->id}}">{{ $parkingPermit->created_at->format('m-d-Y') }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">{{ $parkingPermit->created_at->format('m-d-Y') }}</div>
                    </div>
                    <input type="text" disabled class="form-control" name="parking_permit_number_{{$parkingPermit->id}}" value="{{ $parkingPermit->number }}">
                </div>
            </div>
            </div> <!-- end form row -->
            @endforeach
            @endif