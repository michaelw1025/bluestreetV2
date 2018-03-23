
        <h5 class="alert alert-info mt-5 toggle-section" id="employee-termination">Termination</h5>
        <div class="form-row align-items-center employee-termination {{ $errors->has('termination_type') ? '' : ($errors->has('termination_date') ? '' : ($errors->has('termination_last_day') ? '' : ($errors->has('termination_comments') ? '' : 'd-none'))) }}">

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="termination_update">Add Termination</label>
                <div class="input-group border border-secondary">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Add Termination</div>
                    </div>
                    <div class="form-check form-check-inline ml-4">
                        <input class="form-check-input" type="checkbox" name="termination_update" value="1" {{old('termination_update') ? 'checked' : ''}}>
                        <label class="form-check-label">Check to Add This Termination</label>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="termination_type">Termination Type</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Termination Type</div>
                    </div>
                    <select class="form-control" name="termination_type">
                        <option></option>
                        <option {{ old('termination_type') == 'voluntary' ? 'selected' : ''}} value="voluntary">Voluntary</option>
                        <option {{ old('termination_type') == 'involuntary' ? 'selected' : ''}} value="involuntary">Involuntary</option>
                    </select>
                </div>
                <small class="text-danger">{{ $errors->first('termination_type') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="termination_date">Termination Date</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Termination Date</div>
                    </div>
                    <input type="text" class="form-control ui-datepicker-prev date-pick" name="termination_date" value="{{old('termination_date')}}">
                </div>
                <small class="text-danger">{{ $errors->first('termination_date') }}</small>
            </div>

            <div class="col-xl-4 my-1">
                <label class="sr-only" for="termination_last_day">Last Day Worked</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Last Day Worked</div>
                    </div>
                    <input type="text" class="form-control ui-datepicker-prev date-pick" name="termination_last_day" value="{{old('termination_last_day')}}">
                </div>
                <small class="text-danger">{{ $errors->first('termination_last_day') }}</small>
            </div>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Termination Comments</span>
                </div>
                <textarea class="form-control" name="termination_comments">{{old('termination_comments')}}</textarea>
            </div>
            <small class="text-danger">{{ $errors->first('termination_comments') }}</small>
            
        </div> <!-- end form row -->


















        

        @if($employee->termination->isNotEmpty())
        <hr class="border-info mt-4 mb-4 employee-termination {{ $errors->has('termination_type') ? '' : ($errors->has('termination_date') ? '' : ($errors->has('termination_last_day') ? '' : ($errors->has('termination_comments') ? '' : 'd-none'))) }}"/>
        
        <table class="table table-hover employee-termination {{ $errors->has('termination_type') ? '' : ($errors->has('termination_date') ? '' : ($errors->has('termination_last_day') ? '' : ($errors->has('termination_comments') ? '' : 'd-none'))) }}">
            <thead>
                <tr>
                    <th scope="col">Type</th>
                    <th scope="col">Date</th>
                    <th scope="col">Last Day</th>
                </tr>
            </thead>
            <tbody>
        @foreach($employee->termination as $termination)

                <tr class="clickable-row table-warning" data-href="{{ url('hr.employee-termination/'.$employee->id.'/'.$termination->id) }}">
                    <td>{{$termination->type}}</td>
                    <td>{{$termination->date->format('m-d-Y')}}</td>
                    <td>{{$termination->last_day->format('m-d-Y')}}</td>
                </tr>

        @endforeach

            <tbody>
        </table>
        @endif