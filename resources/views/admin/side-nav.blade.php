<nav class="col-sm-3 col-md-2  d-sm-block bg-white sidebar">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Route::is('admin.users') ? 'active' : '' }}" href="{{ url('admin.users') }}">Site Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="">Site Roles</a>
            </li>
        </ul>
    </nav>