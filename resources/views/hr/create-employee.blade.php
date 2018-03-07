@extends('layouts.app')
@section('content')
<div class="row">
    @include('hr.side-nav') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Add Employee</h1>
        <hr class="border-info"/>
        @include('layouts.session-messages')

        @include('hr.forms.employee-demographic-form')

        <hr class="border-info mt-4 mb-4 prevent-print"/>

        
    </div>
</div>
@endsection