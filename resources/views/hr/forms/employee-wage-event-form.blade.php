
        <h5 class="alert alert-info mt-5 toggle-section" id="employee-wage-event">Wage Event Scale</h5>
        
        <div class="print-section form-row align-items-center employee-wage-event {{ $errors->has('progression') ? '' : 'd-none' }}">
        <p class="ml-1 text-secondary">Enter Appropriate Dates For Wage Event Scale</p>
        </div> <!-- end form row -->

        <div class="print-section form-row align-items-center employee-wage-event {{ $errors->has('progression') ? '' : 'd-none' }}">

        @if($wageProgressions)

        @foreach($wageProgressions as $wageProgression)

        <div class="col-xl-4 my-1">
            <label class="sr-only" for="wage_event[{{$loop->index}}][month]">{{$wageProgression->month}}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">{{$wageProgression->month}}</div>
                </div>
                <input type="text" class="form-control d-none" name="wage_event[{{$loop->index}}][month]" value="{{$wageProgression->id}}">
                @php $wageEventValue = false; @endphp
                    @foreach($employee->wageProgression as $employeeProgression)
                        @if($employeeProgression->id == $wageProgression->id)
                            @php $wageEventValue = true; @endphp
                            @break
                        @endif
                    @endforeach
                <input type="text" class="form-control ui-datepicker-prev date-pick wage-event-scale-date" name="wage_event[{{$loop->index}}][date]" value="{{ $wageEventValue == true ? $employeeProgression->pivot->date->format('m-d-Y') : '' }}">
            </div>
        </div>

        @endforeach
        <button type="button" class="btn btn-warning clear-wage-event-scale ml-1 mt-1" >Clear Scale</button>
        @endif

        </div> <!-- end form row -->