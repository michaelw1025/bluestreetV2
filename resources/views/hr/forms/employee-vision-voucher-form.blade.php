
        <h5 class="alert alert-info mt-5 toggle-section" id="employee-vision-voucher">Vision Voucher</h5>

        <div class="print-section form-row align-items-center employee-vision-voucher d-none">
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="voucher_number">Voucher Number</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Voucher Number</div>
                    </div>
                    <input type="text" class="form-control" name="voucher_number" value="{{ old('voucher_number') }}">
                </div>
                <small class="text-danger">{{ $errors->first('voucher_number') }}</small>
            </div>

            @if(isset($employee))
            @foreach($employee->visionVoucher as $visionVoucher)
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="voucher_number_{{$visionVoucher->id}}">{{ $visionVoucher->created_at->format('m-d-Y') }}</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">{{ $visionVoucher->created_at->format('m-d-Y') }}</div>
                    </div>
                    <input type="text" disabled class="form-control" name="voucher_number_{{$visionVoucher->id}}" value="{{ $visionVoucher->voucher_number }}">
                </div>
                <small class="text-danger">{{ $errors->first('voucher_number') }}</small>
            </div>
            @endforeach
            @endif
        </div> <!-- end form row -->
