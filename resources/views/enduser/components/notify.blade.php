@if(Session::has('success'))
<div class="alert alert-success alert-dismissible" style="
    padding: 10px;
    background: aquamarine;
    margin-bottom: 10px;
">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Success!</strong> {{ Session::get('success') }}
</div>
@endif