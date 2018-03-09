        @if(isset($employee))
        <h5 class="alert alert-info mt-5 toggle-section" id="employee-bidding">Bidding</h5>
        <div class="form-row align-items-center employee-bidding d-none">
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="bid_eligible">Bid Eligible</label>
                <div class="input-group {{ $employee->bid_eligible == '1' ? 'border border-success' : 'border border-danger' }}">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Bid Eligible</div>
                    </div>
                    <div class="form-check form-check-inline ml-4">
                        <input class="form-check-input" type="radio" name="bid_eligible" value="1" {{ $employee->bid_eligible == '1' ? 'checked' : '' }}>
                        <label class="form-check-label">Yes</label>
                    </div>
                    <div class="form-check form-check-inline ml-4">
                        <input class="form-check-input" type="radio" name="bid_eligible" value="0" {{ $employee->bid_eligible == '0' ? 'checked' : '' }}>
                        <label class="form-check-label">No</label>
                    </div>
                    <small class="text-danger">{{ $errors->first('bid_eligible') }}</small>
                </div>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="bid_eligible_date">Bid Eligible Date</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Bid Eligible Date</div>
                    </div>
                    <input type="text" class="form-control ui-datepicker-prev date-pick" name="bid_eligible_date" required value="{{ isset($employee->bid_eligible_date) ? $employee->bid_eligible_date->format('m-d-Y') : old('bid_eligible_date') }}">
                    <small class="text-danger">{{ $errors->first('bid_eligible_date') }}</small>
                </div>
            </div>
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="bid_eligible_comment">Bid Eligible Comment</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Bid Eligible Comment</div>
                    </div>
                    <input type="text" class="form-control" name="bid_eligible_comment" value="{{ isset($employee->bid_eligible_comment) ? $employee->bid_eligible_comment : old('bid_eligible_comment') }}">
                    <small class="text-danger">{{ $errors->first('bid_eligible_comment') }}</small>
                </div>
            </div>
        </div> <!-- end form row -->
        @endif