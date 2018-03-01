@extends('layouts.app')
@section('content')
<div class="row">
    @include('admin.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Site User<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')
        @if($user)

        <!-- <form> -->
        <form method="post" action="">
        {{ csrf_field() }}
            <div class="form-group row">
                <label for="first_name" class="col-sm-2 col-form-label">First</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="first_name" required value="{{$user['first_name']}}">
                    <small class="text-danger">{{ $errors->first('first_name') }}</small>
                </div>
            </div>
            <div class="form-group row">
                <label for="last_name" class="col-sm-2 col-form-label">Last</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="last_name" required value="{{$user['last_name']}}">
                    <small class="text-danger">{{ $errors->first('last_name') }}</small>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="email" class="form-control" name="email" required value="{{$user['email']}}">
                    <small class="text-danger">{{ $errors->first('email') }}</small>
                </div>
            </div>
            <div class="form-group row">
                <label for="role" class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <select name="role" class="form-control" required>
                        @foreach($user['role'] as $userRole)
                        @foreach($roles as $role)
                        <option {{$userRole->id == $role->id ? 'selected' : ''}} value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                        @endforeach
                    </select>
                    <small class="text-danger">{{ $errors->first('role') }}</small>
                </div>
            </div>

            <div class="form-group row prevent-print">
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <button type="submit" class="btn btn-warning" formaction="{{url('admin.users/'.$user['id'].'/edit')}}">Edit User</button>
                    <button type="submit" class="btn btn-danger" formaction="{{url('admin.users/'.$user['id'].'/delete')}}">Delete User</button>
                </div>
            </div>
        </form>
            <!-- </form> -->

            @endif

    </div>
</div>
@endsection