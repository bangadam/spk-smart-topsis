<!-- Sub Criteria Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sub_criteria_id', 'Sub Criteria Id:') !!}
    {!! Form::select('sub_criteria_id', ], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Population Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('population_id', 'Population Id:') !!}
    {!! Form::select('population_id', ], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Value Field -->
<div class="form-group col-sm-6">
    {!! Form::label('value', 'Value:') !!}
    {!! Form::number('value', null, ['class' => 'form-control']) !!}
</div>