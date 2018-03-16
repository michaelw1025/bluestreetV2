
        <h5 class="alert alert-info mt-5 toggle-section" id="employee-wage">Wage</h5>
        <div class="form-row align-items-center employee-wage {{ $errors->has('position') ? '' : ($errors->has('job') ? '' : ($errors->has('cost_center') ? '' : ($errors->has('shift') ? '' : 'd-none'))) }}">
        
       

        @if($wageTitles)
            @foreach($wageTitles as $wageTitle)
            <table class="table table-bordered">
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
                        <td class="text-center">${{$wageProgression->pivot->amount}} &nbsp <input type="radio" name="progression" value="{{$wageProgression->pivot->id}}">{{$wageProgression->pivot->id}}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
            @endforeach
        @endif

        </div> <!-- end form row -->
