@extends('layouts.app')
@section('content')
<div class="row">
    @include('admin.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Site Role<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')
        @if($role)

        <!-- <form> -->
        <form method="post" action="">
        {{ csrf_field() }}
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Role Name</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="name" required value="{{$role['name']}}">
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Role Description</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="description" required value="{{$role['description']}}">
                    <small class="text-danger">{{ $errors->first('description') }}</small>
                </div>
            </div>

            <div class="form-group row prevent-print">
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <button type="submit" class="btn btn-warning" formaction="{{url('admin.roles/'.$role['id'].'/edit')}}">Edit Role</button>
                    <button type="submit" class="btn btn-danger" formaction="{{url('admin.roles/'.$role['id'].'/delete')}}">Delete role</button>
                </div>
            </div>
        </form>
            <!-- </form> -->

            @endif

    </div>
</div>
@endsection