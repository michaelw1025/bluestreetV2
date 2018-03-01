<nav class="col-sm-3 col-md-2  d-sm-block bg-white sidebar ml-2 prevent-print">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Route::is('admin.users') ? 'active' : (Route::is('admin.all-users') ? 'active' : '') }}" href="{{ url('admin.users') }}">Site Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('admin.roles') ? 'active' : (Route::is('admin.all-roles') ? 'active' : '') }}" href="{{ url('admin.roles') }}">Site Roles</a>
            </li>
        </ul>
    </nav>