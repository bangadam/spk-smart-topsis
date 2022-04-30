<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Judul:') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => '2021/2022 - Gelombang I']) !!}
</div>

<!-- Quota Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quota', 'Kuota Penerimaan:') !!}
    {!! Form::number('quota', null, ['class' => 'form-control', 'placeholder' => 100]) !!}
</div>

<!-- Start Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_date', 'Tanggal Dibuka:') !!}
    {!! Form::text('start_date', null, ['class' => 'form-control','id'=>'start_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#start_date').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- End Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end_date', 'Tanggal Ditutup:') !!}
    {!! Form::text('end_date', null, ['class' => 'form-control','id'=>'end_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#end_date').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', \App\Models\Period::getStatus(), null, ['class' => 'form-control custom-select', 'placeholder' => 'Pilih Status']) !!}
</div>
