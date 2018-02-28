@extends('layouts.app')
@section('content')
<div class="row">
    @include('') <!-- side nav for this page -->

    <!-- Content for main window must go within this div -->
    <div class="col mr-sm-3">
        <h1 class="">Page Title</h1>
        <hr class="border-info"/>
    </div>
</div>
@endsection