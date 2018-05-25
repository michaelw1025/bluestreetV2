
        <h5 class="alert alert-info mt-5 toggle-section" id="employee-position">Position</h5>
        <div class="print-section form-row align-items-center employee-position {{ $errors->has('job') ? '' : ($errors->has('position') ? '' : ($errors->has('cost_center') ? '' : ($errors->has('shift') ? '' : 'd-none'))) }}">
        
            @if(isset($jobs))
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="job">Job</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Job</div>
                    </div>
                    <select class="form-control" name="job" required>
                        <option></option>
                        @foreach($jobs as $job)
                        <option {{ isset($employee->job) ? ($employee->job[0]->id == $job->id ? 'selected' : '') : (old('job') == $job->id ? 'selected' : '') }} value="{{$job->id}}">{{$job->description}}</option>
                        @endforeach
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('job') }}</small>
            </div>
            @endif

            @if(isset($positions))
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="position">Position</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Position</div>
                    </div>
                    <select class="form-control position-select" name="position" required>
                        <option></option>
                        @foreach($positions as $position)
                        <option id="title-{{$position->wageTitle[0]->id}}-{{$position->wageTitle[0]->description}}" {{ isset($employee->position) ? ($employee->position[0]->id == $position->id ? 'selected' : '') : (old('position') == $position->id ? 'selected' : '') }} value="{{$position->id}}">{{$position->description}}</option>
                        @endforeach
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('position') }}</small>
            </div>
            @endif

            @if(isset($costCenters))
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="cost_center">Cost Center</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Cost Center</div>
                    </div>
                    <select class="form-control" name="cost_center" required>
                        <option></option>
                        @foreach($costCenters as $costCenter)
                        <option {{ isset($employee->costCenter) ? ($employee->costCenter[0]->id == $costCenter->id ? 'selected' : '') : (old('cost_center') == $costCenter->id ? 'selected' : '') }} value="{{$costCenter->id}}">{{$costCenter->number}} - {{$costCenter->description}}</option>
                        @endforeach
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('cost_center') }}</small>
            </div>
            @endif

            @if(isset($shifts))
            <div class="col-xl-4 my-1">
                <label class="sr-only" for="shift">Shift</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="text-danger prevent-print">*</span>&nbsp;Shift</div>
                    </div>
                    <select class="form-control" name="shift" required>
                        <option></option>
                        @foreach($shifts as $shift)
                        <option {{ isset($employee->shift) ? ($employee->shift[0]->id == $shift->id ? 'selected' : '') : (old('shift') == $shift->id ? 'selected' : '') }} value="{{$shift->id}}">{{$shift->description}}</option>
                        @endforeach
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('shift') }}</small>
            </div>
            @endif

        </div> <!-- end form row -->
