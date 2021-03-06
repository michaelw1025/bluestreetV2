<nav class="col-sm-3 col-md-2  d-sm-block bg-white sidebar ml-2 prevent-print">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ Route::is('hr.employee-termination') ? 'active' : (Route::is('hr.employee-disciplinary') ? 'active' : (Route::is('hr.employee-reduction') ? 'active' : (Route::is('hr.all-employees') ? 'active' : (Route::is('hr.employees') ? 'active' : (Route::is('hr.create-employee') ? 'active' : ''))))) }}" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Employee</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ url('hr.create-employee') }}">Add New</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url('hr.all-employees/active') }}">Search Active</a>
                    <a class="dropdown-item" href="{{ url('hr.all-employees/inactive') }}">Search Inactive</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ Route::is('hr.query-employees-bonus-hours') ? 'active' : '' }} {{ Route::is('hr.query-employees-wage-progression') ? 'active' : '' }} {{ Route::is('hr.query-ssn') ? 'active' : '' }} {{ Route::is('hr.query-cost-center') ? 'active' : '' }} {{ Route::is('hr.query-hire-date') ? 'active' : '' }} {{ Route::is('hr.query-birthdays') ? 'active' : '' }} {{ Route::is('hr.query-employees-seniority') ? 'active' : '' }} {{ Route::is('hr.query-anniversaries') ? 'active' : '' }} {{ Route::is('hr.query-turnovers') ? 'active' : '' }} {{ Route::is('hr.query-reductions') ? 'active' : '' }} {{ Route::is('hr.query-reviews') ? 'active' : '' }} {{ Route::is('hr.query-employees-alphabetical') ? 'active' : '' }}" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Queries</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ url('hr.query-employees-alphabetical') }}">Employee List - Aphabetical</a>
                    <a class="dropdown-item" href="{{ url('hr.query-employees-seniority') }}">Employee List - Seniority</a>
                    <a class="dropdown-item" href="{{ url('hr.query-reviews') }}">Reviews</a>
                    <a class="dropdown-item" href="{{ url('hr.query-reductions') }}">Reductions</a>
                    <a class="dropdown-item" href="{{ url('hr.query-turnovers') }}">Turnover</a>
                    <a class="dropdown-item" href="{{ url('hr.query-anniversaries') }}">Anniversaries</a>
                    <a class="dropdown-item" href="{{ url('hr.query-birthdays') }}">Birthdays</a>
                    <a class="dropdown-item" href="{{ url('hr.query-hire-date') }}">Hire Date</a>
                    <a class="dropdown-item" href="{{ url('hr.query-cost-center') }}">Cost Center</a>
                    <a class="dropdown-item" href="{{ url('hr.query-ssn') }}">Find SSN</a>
                    <a class="dropdown-item" href="{{ url('hr.query-employees-wage-progression') }}">Wage Progressions</a>
                    <a class="dropdown-item" href="{{ url('hr.query-employees-bonus-hours') }}">Bonus Hours</a>
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
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ Route::is('hr.create-bid') ? 'active' : '' }}" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Bidding</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ url('hr.create-bid') }}">Create Bid</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle {{ Route::is('hr.create-contractor-employee') ? 'active' : '' }} {{ Route::is('hr.show-contractor') ? 'active' : '' }} {{ Route::is('hr.store-contractor') ? 'active' : '' }} {{ Route::is('hr.create-contractor') ? 'active' : '' }}" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Contractors</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ url('hr.create-contractor') }}">Contractors</a>
                    <a class="dropdown-item" href="{{ url('hr.create-contractor-employee') }}">Contractor Employees</a>
                </div>
            </li>
        </ul>
    </nav>
