@extends('layouts.app')
@section('content')
<div class="row">
    @include('admin.side-nav')

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3 main-div">
        <h1 class="">Admin Home</h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')
    </div>
</div>
@endsection