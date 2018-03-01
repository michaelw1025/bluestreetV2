@extends('layouts.app')
@section('content')
<div class="row">
    @include('') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Page Title<button type="button" class="btn btn-info pl- pr-3 float-right btn-lg print-button">Print</button></h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')
    </div>
</div>
@endsection