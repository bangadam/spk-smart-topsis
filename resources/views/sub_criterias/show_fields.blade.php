<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $subCriteria->name }}</p>
</div>

<!-- Weight Field -->
<div class="col-sm-12">
    {!! Form::label('weight', 'Weight:') !!}
    <p>{{ $subCriteria->weight }}</p>
</div>

<!-- Criteria Id Field -->
<div class="col-sm-12">
    {!! Form::label('criteria_id', 'Criteria Id:') !!}
    <p>{{ $subCriteria->criteria_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $subCriteria->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $subCriteria->updated_at }}</p>
</div>

