@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    {{ $message }}
</div>
@endif
@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
    {{ $message }}
</div>
@endif
@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
    {{ $message }}
</div>
@endif
@if ($message = Session::get('info'))
<div class="alert alert-info alert-block">
    {{ $message }}
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger">
    Following errors occurred.
    {!! implode('', $errors->all('<div>:message</div>')) !!}
</div>
@endif
