<nav class="col-sm-3 col-md-2  d-sm-block bg-white sidebar ml-2 prevent-print">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ Route::is('hr.all-employees') ? 'active' : (Route::is('hr.employees') ? 'active' : (Route::is('hr.create-employee') ? 'active' : '')) }}" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Employee</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ url('hr.create-employee') }}">Add New</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url('hr.all-employees/active') }}">Search Active</a>
                    <a class="dropdown-item" href="{{ url('hr.all-employees/inactive') }}">Search Inactive</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ Route::is('hr.all-wage-titles') ? 'active' : (Route::is('hr.wage-titles') ? 'active' : '') }} {{ Route::is('hr.all-wage-progressions') ? 'active' : (Route::is('hr.wage-progressions') ? 'active' : '') }} {{ Route::is('hr.all-teams') ? 'active' : (Route::is('hr.teams') ? 'active' : '') }} {{ Route::is('hr.all-shifts') ? 'active' : (Route::is('hr.shifts') ? 'active' : '') }} {{ Route::is('hr.all-positions') ? 'active' : (Route::is('hr.positions') ? 'active' : '') }} {{ Route::is('hr.all-jobs') ? 'active' : (Route::is('hr.jobs') ? 'active' : '') }} {{ Route::is('hr.all-cost-centers') ? 'active' : (Route::is('hr.cost-centers') ? 'active' : '') }}" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Manage</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ url('hr.cost-centers') }}">Cost Centers</a>
                    <a class="dropdown-item" href="{{ url('hr.jobs') }}">Jobs</a>
                    <a class="dropdown-item" href="{{ url('hr.positions') }}">Positions</a>
                    <a class="dropdown-item" href="{{ url('hr.shifts') }}">Shifts</a>
                    <a class="dropdown-item" href="{{ url('hr.teams') }}">Teams</a>
                    <a class="dropdown-item" href="{{ url('hr.wage-progressions') }}">Wage Progressions</a>
                    <a class="dropdown-item" href="{{ url('hr.wage-titles') }}">Wage Titles</a>
                    <!-- <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="">Search Active</a>
                    <a class="dropdown-item" href="">Search Inactive</a> -->
                </div>
            </li>
        </ul>
    </nav>