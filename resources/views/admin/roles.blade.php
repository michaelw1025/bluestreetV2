@extends('layouts.app')
@section('content')
<div class="row">
    @include('admin.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Site Roles<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button prevent-print">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')



        <h3 class="prevent-print">Add Role</h3>
        <!-- <form> -->
        <form method="post" action="" class="prevent-print">
        {{ csrf_field() }}
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Role Name</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="name" required value="{{old('name')}}">
                    <small class="text-danger">{{ $errors->first('name') }}</small>
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Role Description</label>
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <input type="text" class="form-control" name="description" required value="{{old('description')}}">
                    <small class="text-danger">{{ $errors->first('description') }}</small>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-sm-10 col-md-8 col-lg-6">
                    <button type="submit" class="btn btn-success" formaction="{{url('admin.roles')}}">Create Role</button>
                </div>
            </div>
        </form>
        <!-- </form> -->
        <hr class="border-info mt-4 mb-4 prevent-print"/>





        @if($roles)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr class="clickable-row" data-href="{{ url('admin.roles/'.$role->id) }}">
                        <td>{{$role->name}}</td>
                        <td>{{$role->description}}</td>
                    </tr>
                @endforeach
                <tbody>
            </table>
        @endif
    </div>
</div>
@endsection