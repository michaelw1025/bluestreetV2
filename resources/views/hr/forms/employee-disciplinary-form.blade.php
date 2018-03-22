
        <h5 class="alert alert-info mt-5 toggle-section" id="employee-disciplinary">Disciplinary</h5>
        <div class="form-row align-items-center employee-disciplinary ">

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="disciplinary_update">Add Disciplinary</label>
                <div class="input-group border border-secondary">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Add Disciplinary</div>
                    </div>
                    <div class="form-check form-check-inline ml-4">
                        <input class="form-check-input" type="checkbox" name="disciplinary_update" value="1">
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
                        <option value="attendance">Attendance</option>
                        <option value="performance">Performance</option>
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
                        <option value="first">First</option>
                        <option value="second">Second</option>
                        <option value="final">Final</option>
                        <option value="hr review">HR Review</option>
                        <option value="2nd hr review">2nd HR Review</option>
                        <option value="discussion">Discussion</option>
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
                    <input type="text" class="form-control ui-datepicker-prev date-pick" name="disciplinary_date" value="">
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
                        <option value="{{$costCenter->id}}">{{$costCenter->number}} - {{$costCenter->description}}</option>
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
                        <option value="{{$salaryEmployee->pivot->employee_id}}">{{$salaryEmployee->first_name}} {{$salaryEmployee->last_name}}</option>
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
                <textarea class="form-control" name="disciplinary_comments"></textarea>
            </div>
            
        </div> <!-- end form row -->


















        <hr class="border-info mt-4 mb-4"/>

        @if($employee->disciplinary->isNotEmpty())
        
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Type</th>
                    <th scope="col">Level</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
        @foreach($employee->disciplinary as $disciplinary)
        @if($disciplinary->type == 'attendance')
                <tr class="clickable-row table-warning" data-href="{{ url('hr.employee-disciplinary/'.$employee->id.'/'.$disciplinary->id) }}">
                    <td>{{$disciplinary->type}}</td>
                    <td>{{$disciplinary->level}}</td>
                    <td>{{$disciplinary->date->format('m-d-Y')}}</td>
                </tr>
        @endif
        @endforeach
                <tr class="bg-dark">
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