<div class="form-group col-sm-12">
    {!! Form::label('periode', 'Periode Bantuan:') !!}
    {!! Form::select('periode', $periods, null, ['class' => 'form-control custom-select']) !!}

    {{-- population_id --}}
    {!! Form::hidden('population_id', request()->query('population_id')) !!}
</div>

{!! App\Models\Criteria::criteriaFormGenerator() !!}
