<!-- Sub Criteria Id Field -->
<div class="col-sm-12">
    {!! Form::label('sub_criteria_id', 'Sub Criteria Id:') !!}
    <p>{{ $populationAssesment->sub_criteria_id }}</p>
</div>

<!-- Population Id Field -->
<div class="col-sm-12">
    {!! Form::label('population_id', 'Population Id:') !!}
    <p>{{ $populationAssesment->population_id }}</p>
</div>

<!-- Value Field -->
<div class="col-sm-12">
    {!! Form::label('value', 'Value:') !!}
    <p>{{ $populationAssesment->value }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $populationAssesment->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $populationAssesment->updated_at }}</p>
</div>

