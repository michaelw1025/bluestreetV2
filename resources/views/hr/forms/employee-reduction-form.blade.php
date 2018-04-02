
        <h5 class="alert alert-info mt-5 toggle-section" id="employee-reduction">Reduction</h5>
        <p class="text-info prevent-print employee-reduction d-none">* indicates a required field if Add Reduction is checked</p>
        <div class="print-section form-row align-items-center employee-reduction {{ $errors->has('reduction_type') ? '' : ($errors->has('reduction_displacement') ? '' : ($errors->has('reduction_date') ? '' : ($errors->has('reduction_home_cost_center') ? '' : ($errors->has('reduction_bump_to_cost_center') ? '' : ($errors->has('reduction_home_shift') ? '' : ($errors->has('reduction_bump_to_shift') ? '' : ($errors->has('reduction_fiscal_week') ? '' : ($errors->has('reduction_fiscal_year') ? '' : ($errors->has('reduction_comments') ? '' : 'd-none'))))))))) }}">

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="reduction_update">Add Reduction</label>
                <div class="input-group border border-secondary">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Add Reduction</div>
                    </div>
                    <div class="form-check form-check-inline ml-4">
                        <input class="form-check-input" type="checkbox" name="reduction_update" value="1" {{old('reduction_update') ? 'checked' : ''}}>
                        <label class="form-check-label">Check to Set This Reduction as Active</label>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="reduction_type">Reduction Type</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-info prevent-print">*</span>&nbsp;Reduction Type</div>
                    </div>
                    <select class="form-control" name="reduction_type">
                        <option></option>
                        <option {{ old('reduction_type') == 'voluntary' ? 'selected' : ''}} value="voluntary">Voluntary</option>
                        <option {{ old('reduction_type') == 'involuntary' ? 'selected' : ''}} value="involuntary">Involuntary</option>
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('reduction_type') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="reduction_displacement">Reduction Displacement</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-info prevent-print">*</span>&nbsp;Reduction Displacement</div>
                    </div>
                    <select class="form-control" name="reduction_displacement">
                        <option></option>
                        <option {{ old('reduction_displacement') == 'layoff' ? 'selected' : ''}} value="layoff">Layoff</option>
                        <option {{ old('reduction_displacement') == 'bump' ? 'selected' : ''}} value="bump">Bump</option>
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('reduction_displacement') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="reduction_date">Reduction Date</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-info prevent-print">*</span>&nbsp;Reduction Date</div>
                    </div>
                    <input type="text" class="form-control ui-datepicker-prev date-pick" name="reduction_date" value="{{old('reduction_date')}}">
                </div>
                <small class="text-danger">{{ $errors->first('reduction_date') }}</small>
            </div>

            @if(isset($costCenters))
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="reduction_home_cost_center">Home Cost Center</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-info prevent-print">*</span>&nbsp;Home Cost Center</div>
                    </div>
                    <select class="form-control" name="reduction_home_cost_center">
                        <option></option>
                        @foreach($costCenters as $costCenter)
                        <option {{ old('reduction_home_cost_center') == $costCenter->id ? 'selected' : '' }} value="{{$costCenter->id}}">{{$costCenter->number}} - {{$costCenter->description}}</option>
                        @endforeach
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('reduction_home_cost_center') }}</small>
            </div>
            @endif

            @if(isset($costCenters))
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="reduction_bump_to_cost_center">Bump To Cost Center</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Bump To Cost Center</div>
                    </div>
                    <select class="form-control" name="reduction_bump_to_cost_center">
                        <option></option>
                        @foreach($costCenters as $costCenter)
                        <option {{ old('reduction_bump_to_cost_center') == $costCenter->id ? 'selected' : '' }} value="{{$costCenter->id}}">{{$costCenter->number}} - {{$costCenter->description}}</option>
                        @endforeach
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('reduction_bump_to_cost_center') }}</small>
            </div>
            @endif

            @if(isset($shifts))
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="reduction_home_shift">Home Shift</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-info prevent-print">*</span>&nbsp;Home Shift</div>
                    </div>
                    <select class="form-control" name="reduction_home_shift">
                        <option></option>
                        @foreach($shifts as $shift)
                        <option {{ old('reduction_home_shift') == $shift->id ? 'selected' : '' }} value="{{$shift->id}}">{{$shift->description}}</option>
                        @endforeach
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('reduction_home_shift') }}</small>
            </div>
            @endif

            @if(isset($shifts))
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="reduction_bump_to_shift">Bump To Shift</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Bump To Shift</div>
                    </div>
                    <select class="form-control" name="reduction_bump_to_shift">
                        <option></option>
                        @foreach($shifts as $shift)
                        <option {{ old('reduction_bump_to_shift') == $shift->id ? 'selected' : '' }} value="{{$shift->id}}">{{$shift->description}}</option>
                        @endforeach
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('reduction_bump_to_shift') }}</small>
            </div>
            @endif

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="reduction_fiscal_week">Fiscal Week</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-info prevent-print">*</span>&nbsp;Fiscal Week</div>
                    </div>
                    <input type="text" class="form-control" name="reduction_fiscal_week" value="{{old('reduction_fiscal_week')}}">
                </div>
                <small class="text-danger">{{ $errors->first('reduction_fiscal_week') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="reduction_fiscal_year">Fiscal Year</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-info prevent-print">*</span>&nbsp;Fiscal Year</div>
                    </div>
                    <input type="text" class="form-control" name="reduction_fiscal_year" value="{{old('reduction_fiscal_year')}}">
                </div>
                <small class="text-danger">{{ $errors->first('reduction_fiscal_year') }}</small>
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><span class="text-info prevent-print">*</span>&nbsp;Reduction Comments</span>
                </div>
                <textarea class="form-control" name="reduction_comments">{{old('reduction_comments')}}</textarea>
            </div>
            <small class="text-danger">{{ $errors->first('reduction_comments') }}</small>
            
        </div> <!-- end form row -->


















        

        @if($employee->reduction->isNotEmpty())
        <hr class="print-section border-info mt-4 mb-4 employee-reduction {{ $errors->has('reduction_type') ? '' : ($errors->has('reduction_displacement') ? '' : ($errors->has('reduction_date') ? '' : ($errors->has('reduction_home_cost_center') ? '' : ($errors->has('reduction_bump_to_cost_center') ? '' : ($errors->has('reduction_home_shift') ? '' : ($errors->has('reduction_bump_to_shift') ? '' : ($errors->has('reduction_fiscal_week') ? '' : ($errors->has('reduction_fiscal_year') ? '' : ($errors->has('reduction_comments') ? '' : 'd-none'))))))))) }}"/>
        
        <table class="print-section table table-hover employee-reduction {{ $errors->has('reduction_type') ? '' : ($errors->has('reduction_displacement') ? '' : ($errors->has('reduction_date') ? '' : ($errors->has('reduction_home_cost_center') ? '' : ($errors->has('reduction_bump_to_cost_center') ? '' : ($errors->has('reduction_home_shift') ? '' : ($errors->has('reduction_bump_to_shift') ? '' : ($errors->has('reduction_fiscal_week') ? '' : ($errors->has('reduction_fiscal_year') ? '' : ($errors->has('reduction_comments') ? '' : 'd-none'))))))))) }}">
            <thead>
                <tr>
                    <th scope="col">Type</th>
                    <th scope="col">Displacement</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
        @foreach($employee->reduction as $reduction)
        @if($reduction->currently_active == '1')
                <tr class="clickable-row table-warning" data-href="{{ url('hr.employee-reduction/'.$employee->id.'/'.$reduction->id) }}">
                    <td>{{$reduction->type}}</td>
                    <td>{{$reduction->displacement}}</td>
                    <td>{{$reduction->date->format('m-d-Y')}}</td>
                </tr>
        @endif
        @endforeach
                <tr class="bg-dark">
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
        @foreach($employee->reduction as $reduction)
        @if($reduction->currently_active == '0')
                <tr class="clickable-row table-danger" data-href="{{ url('hr.employee-reduction/'.$employee->id.'/'.$reduction->id) }}">
                    <td>{{$reduction->type}}</td>
                    <td>{{$reduction->displacement}}</td>
                    <td>{{$reduction->date->format('m-d-Y')}}</td>
                </tr>
        @endif
        @endforeach
            <tbody>
        </table>
        @endif