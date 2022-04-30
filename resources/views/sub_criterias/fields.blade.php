<!-- Criteria Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('criteria_id', 'Pilih Kriteria:') !!}
    {!! Form::select('criteria_id', $criterias, null, ['class' => 'form-control custom-select', 'placeholder' => 'Pilih Kriteria']) !!}
</div>

<div class="row">
    @foreach (range(1, App\Models\SubCriteria::getMaxSubCriteria()) as $index)
        <div class="form-group col-sm-12">
            <span>Sub Kriteria {{$index}}</span>
            <hr>
        </div>
        <!-- Name Field -->
        <div class="form-group col-sm-6">
            {!! Form::text('name[]', null, ['class' => 'form-control','placeholder' => 'Nama Sub Kriteria']) !!}
        </div>

        <!-- Weight Field -->
        <div class="form-group col-sm-6">
            {!! Form::select('weight[]', App\Models\SubCriteria::getWeights(), null, ['class' => 'form-control custom-select', 'placeholder' => 'Pilih bobot']) !!}
        </div>
    @endforeach
</div>
