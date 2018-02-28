@extends('layouts.app')
@section('content')
<div class="row">
    @include('admin.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Site Users</h1>
        <hr class="border-info"/>
        @if($users)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr class="clickable-row" data-href="{{ url('admin.users/'.$user->id) }}">
                        <td>{{$user->first_name}}</td>
                        <td>{{$user->last_name}}</td>
                        <td>{{$user->email}}</td>
                        @foreach($user->role as $role)
                        <td>{{$role->name}}</td>
                        @endforeach
                    </tr>
                @endforeach
                <tbody>
            </table>
        @endif
    </div>
</div>
@endsection