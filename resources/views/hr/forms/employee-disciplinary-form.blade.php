
        <h5 class="alert alert-info mt-5 toggle-section" id="employee-disciplinary">Disciplinary</h5>
        <div class="form-row align-items-center employee-disciplinary {{ $errors->has('disciplinary_type') ? '' : ($errors->has('disciplinary_level') ? '' : ($errors->has('disciplinary_date') ? '' : ($errors->has('disciplinary_cost_center') ? '' : ($errors->has('disciplinary_issued_by') ? '' : ($errors->has('disciplinary_comments') ? '' : 'd-none'))))) }}">

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="disciplinary_update">Add Disciplinary</label>
                <div class="input-group border border-secondary">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Add Disciplinary</div>
                    </div>
                    <div class="form-check form-check-inline ml-4">
                        <input class="form-check-input" type="checkbox" name="disciplinary_update" value="1" {{old('disciplinary_update') ? 'checked' : ''}}>
                        <label class="form-check-label">Check to Add This Disciplinary</label>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="disciplinary_type">Disciplinary Type</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Disciplinary Type</div>
                    </div>
                    <select class="form-control" name="disciplinary_type">
                        <option></option>
                        <option {{ old('disciplinary_type') == 'attendance' ? 'selected' : ''}} value="attendance">Attendance</option>
                        <option {{ old('disciplinary_type') == 'performance' ? 'selected' : ''}} value="performance">Performance</option>
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('disciplinary_type') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="disciplinary_level">Disciplinary Level</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Disciplinary Level</div>
                    </div>
                    <select class="form-control" name="disciplinary_level">
                        <option></option>
                        <option {{ old('disciplinary_level') == 'first' ? 'selected' : '' }} value="first">First</option>
                        <option {{ old('disciplinary_level') == 'second' ? 'selected' : '' }} value="second">Second</option>
                        <option {{ old('disciplinary_level') == 'final' ? 'selected' : '' }} value="final">Final</option>
                        <option {{ old('disciplinary_level') == 'hr review' ? 'selected' : '' }} value="hr review">HR Review</option>
                        <option {{ old('disciplinary_level') == '2nd hr review' ? 'selected' : '' }} value="2nd hr review">2nd HR Review</option>
                        <option {{ old('disciplinary_level') == 'discussion' ? 'selected' : '' }} value="discussion">Discussion</option>
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('disciplinary_level') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="disciplinary_date">Disciplinary Date</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Disciplinary Date</div>
                    </div>
                    <input type="text" class="form-control ui-datepicker-prev date-pick" name="disciplinary_date" value="{{old('disciplinary_date')}}">
                </div>
                <small class="text-danger">{{ $errors->first('disciplinary_date') }}</small>
            </div>

            @if(isset($costCenters))
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="disciplinary_cost_center">Cost Center</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Cost Center</div>
                    </div>
                    <select class="form-control" name="disciplinary_cost_center">
                        <option></option>
                        @foreach($costCenters as $costCenter)
                        <option {{ old('disciplinary_cost_center') == $costCenter->id ? 'selected' : '' }} value="{{$costCenter->id}}">{{$costCenter->number}} - {{$costCenter->description}}</option>
                        @endforeach
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('disciplinary_cost_center') }}</small>
            </div>
            @endif

            @if(isset($salaryPositions))
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="disciplinary_issued_by">Issued By</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Issued By</div>
                    </div>
                    <select class="form-control" name="disciplinary_issued_by">
                        <option></option>
                        @foreach($salaryPositions as $salaryPosition)
                        @foreach($salaryPosition->employee as $salaryEmployee)
                        <option {{ old('disciplinary_issued_by') == $salaryEmployee->pivot->employee_id ? 'selected' : '' }} value="{{$salaryEmployee->pivot->employee_id}}">{{$salaryEmployee->first_name}} {{$salaryEmployee->last_name}}</option>
                        @endforeach
                        @endforeach
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('disciplinary_issued_by') }}</small>
            </div>
            @endif

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Disciplinary Comments</span>
                </div>
                <textarea class="form-control" name="disciplinary_comments">{{old('disciplinary_comments')}}</textarea>
            </div>
            <small class="text-danger">{{ $errors->first('disciplinary_comments') }}</small>
            
        </div> <!-- end form row -->


















        

        @if($employee->disciplinary->isNotEmpty())
        <hr class="border-info mt-4 mb-4 employee-disciplinary {{ $errors->has('disciplinary_type') ? '' : ($errors->has('disciplinary_level') ? '' : ($errors->has('disciplinary_date') ? '' : ($errors->has('disciplinary_cost_center') ? '' : ($errors->has('disciplinary_issued_by') ? '' : ($errors->has('disciplinary_comments') ? '' : 'd-none'))))) }}"/>
        
        <table class="table table-hover employee-disciplinary {{ $errors->has('disciplinary_type') ? '' : ($errors->has('disciplinary_level') ? '' : ($errors->has('disciplinary_date') ? '' : ($errors->has('disciplinary_cost_center') ? '' : ($errors->has('disciplinary_issued_by') ? '' : ($errors->has('disciplinary_comments') ? '' : 'd-none'))))) }}">
            <thead>
                <tr>
                    <th scope="col">Type</th>
                    <th scope="col">Level</th>
                    <th scope="col">Date</th>
                    <th scope="col">Cost Center</th>
                    <th scope="col">Issued By</th>
                </tr>
            </thead>
            <tbody>
        @foreach($employee->disciplinary as $disciplinary)
        @if($disciplinary->type == 'attendance')
                <tr class="clickable-row table-warning" data-href="{{ url('hr.employee-disciplinary/'.$employee->id.'/'.$disciplinary->id) }}">
                    <td>{{$disciplinary->type}}</td>
                    <td>{{$disciplinary->level}}</td>
                    <td>{{$disciplinary->date->format('m-d-Y')}}</td>
                    @if(isset($costCenters))
                    @foreach($costCenters as $costCenter)
                    @if($disciplinary->cost_center == $costCenter->id)
                    <td>{{$costCenter->number}}</td>
                    @endif
                    @endforeach
                    @endif
                    @if(isset($salaryPositions))
                    @foreach($salaryPositions as $salaryPosition)
                    @foreach($salaryPosition->employee as $salaryEmployee)
                    @if($disciplinary->issued_by == $salaryEmployee->pivot->employee_id)
                    <td>{{$salaryEmployee->first_name}} {{$salaryEmployee->last_name}}</td>
                    @endif
                    @endforeach
                    @endforeach
                    @endif
                </tr>
        @endif
        @endforeach
                <tr class="bg-dark">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
        @foreach($employee->disciplinary as $disciplinary)
        @if($disciplinary->type == 'performance')
                <tr class="clickable-row table-danger" data-href="{{ url('hr.employee-disciplinary/'.$employee->id.'/'.$disciplinary->id) }}">
                    <td>{{$disciplinary->type}}</td>
                    <td>{{$disciplinary->level}}</td>
                    <td>{{$disciplinary->date->format('m-d-Y')}}</td>
                </tr>
        @endif
        @endforeach
            <tbody>
        </table>
        @endif