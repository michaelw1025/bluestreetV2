@if(session('status') !== null)
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endisset
@if(session('error') !== null)
<div class="alert alert-danger" role="alert">
    {{ session('error') }}
</div>
@endisset
@if($errors->any())
<div class="alert alert-danger" role="alert">
    Please correct any errors.
</div>
@endif