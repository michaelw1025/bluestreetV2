
        <h5 class="alert alert-info mt-5 toggle-section" id="employee-wage">Wage</h5>
        <div class="form-row align-items-center employee-wage {{ $errors->has('progression') ? '' : 'd-none' }}">
        
        @if($wageTitles)
            @foreach($wageTitles as $wageTitle)
            <table class="table table-bordered progression-{{$wageTitle->description}} wage-progression-table {{isset($employee->job) ? ($employee->job[0]->wageTitle[0]->id == $wageTitle->id ? '' : 'd-none') : 'd-none'}}">
                <caption><span class="text-info">Current Wage</span> || <span class="text-danger">Eligible Wage</span></caption>
                <thead class="thead-light">
                    <tr>
                        <th scope="col"></th>
                        @foreach($wageTitle->wageProgression as $wageProgression)
                        <th scope="col" class="text-center">{{$wageProgression->month}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>{{$wageTitle->description}}</th>
                        @foreach($wageTitle->wageProgression as $wageProgression)
                        <td class="text-center {{ isset($employee) ? ($employee->wage_progression_wage_title_count > '0' ? ($employee->wageProgressionWageTitle[0]->id == $wageProgression->pivot->id ? 'bg-info text-white' : '') : '') : (old('progression') == $wageProgression->pivot->id ? 'bg-info text-white' : '') }}">${{$wageProgression->pivot->amount}} &nbsp <input type="radio" name="progression" value="{{$wageProgression->pivot->id}}" {{ isset($employee) ? ($employee->wage_progression_wage_title_count > '0' ? ($employee->wageProgressionWageTitle[0]->id == $wageProgression->pivot->id ? 'checked' : '') : '') : (old('progression') == $wageProgression->pivot->id ? 'checked' : '') }}></td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
            @endforeach
        @endif
        <small class="text-danger">{{ $errors->first('progression') }}</small>

        </div> <!-- end form row -->