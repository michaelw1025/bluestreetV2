
        <h5 class="alert alert-info mt-5 toggle-section" id="employee-wage-event">Wage Event Scale</h5>
        <div class="print-section form-row align-items-center employee-wage-event {{ $errors->has('progression') ? '' : 'd-none' }}">
        
        @if($wageProgressions)
            <table class="table table-bordered   ">
                <caption>Enter Appropriate Dates For Event Scale</caption>
                <thead class="thead-light">
                    <tr>
                        <th scope="col"><button type="button" class="btn btn-warning clear-wage-event-scale" >Clear Scale</button></th>
                        @foreach($wageProgressions as $wageProgression)
                        <th scope="col" class="text-center">{{$wageProgression->month}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Event Dates</th>
                        @foreach($wageProgressions as $wageProgression)
                        @php $wageEventValue = false; @endphp
                        @foreach($employee->wageProgression as $employeeProgression)
                            @if($employeeProgression->id == $wageProgression->id)
                                @php $wageEventValue = true; @endphp
                                @break
                            @endif
                        @endforeach
                        <td class="text-center"><input type="text" class="form-control d-none" name="wage_event[{{$loop->index}}][month]" value="{{$wageProgression->id}}"><input type="text" class="form-control ui-datepicker-prev date-pick wage-event-scale-date" name="wage_event[{{$loop->index}}][date]" value="{{ $wageEventValue == true ? $employeeProgression->pivot->date->format('m-d-Y') : '' }}"></td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        @endif
        <small class="text-danger">{{ $errors->first('progression') }}</small>

        

        </div> <!-- end form row -->