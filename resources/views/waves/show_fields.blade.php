<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $wave->name }}</p>
</div>

<!-- Quota Field -->
<div class="col-sm-12">
    {!! Form::label('quota', 'Quota:') !!}
    <p>{{ $wave->quota }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $wave->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $wave->updated_at }}</p>
</div>

