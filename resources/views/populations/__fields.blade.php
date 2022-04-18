<!-- Card Id Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('card_id_number', 'Nomor KTP:') !!}
    {!! Form::text('card_id_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Family Card Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('family_card_id', 'Nomor Kartu Keluarga:') !!}
    {!! Form::text('family_card_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nama Sesuai KTP:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone_number', 'Nomor HP:') !!}
    {!! Form::text('phone_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Gender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gender', 'Jenis Kelamin:') !!}
    {!! Form::select('gender', $gender, null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Birth Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('birth_date', 'Tanggal Lahir:') !!}
    {!! Form::text('birth_date', null, ['class' => 'form-control','id'=>'birth_date']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('address', 'Alamat Lengkap:') !!}
    {!! Form::textarea('address', null, ['class' => 'form-control']) !!}
</div>

<!-- Village Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('province_id', 'Pilih Provinsi:') !!}
    {!! Form::select('province_id', $provinces, null, ['class' => 'form-control custom-select', 'placeholder' => 'Pilih Provinsi']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('city_id', 'Pilih Kota/Kabupaten:') !!}
    {!! Form::select('city_id', [], null, ['class' => 'form-control custom-select']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('district_id', 'Pilih Kecamatan:') !!}
    {!! Form::select('district_id', [], null, ['class' => 'form-control custom-select']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('village_id', 'Pilih Desa:') !!}
    {!! Form::select('village_id', [], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Zip Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('zip_code', 'Kode Pos:') !!}
    {!! Form::text('zip_code', null, ['class' => 'form-control']) !!}
</div>


@push('page_scripts')
    <script type="text/javascript">
        // on change province
        $('#province_id').on('change', function() {
            var province_id = $(this).val();
            if(province_id) {
                $.ajax({
                    url: `{!! route('api.indonesia.cities', ':province_id') !!}`.replace(':province_id', province_id),
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        data = data.data
                        $('#city_id').empty();
                        $('#city_id').append('<option value="">Pilih Kota/Kabupaten</option>');
                        $.each(data, function(key, value) {
                            $('#city_id').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            }else{
                $('#city_id').empty();
                $('#city_id').append('<option value="">Pilih Kota/Kabupaten</option>');
            }
        });

        // on change city
        $('#city_id').on('change', function() {
            var city_id = $(this).val();
            if(city_id) {
                $.ajax({
                    url: `{!! route('api.indonesia.districts', ':city_id') !!}`.replace(':city_id', city_id),
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        data = data.data
                        $('#district_id').empty();
                        $('#district_id').append('<option value="">Pilih Kecamatan</option>');
                        $.each(data, function(key, value) {
                            $('#district_id').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            }else{
                $('#district_id').empty();
                $('#district_id').append('<option value="">Pilih Kecamatan</option>');
            }
        });

        // on change district
        $('#district_id').on('change', function() {
            var district_id = $(this).val();
            if(district_id) {
                $.ajax({
                    url: `{!! route('api.indonesia.villages', ':district_id') !!}`.replace(':district_id', district_id),
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        data = data.data
                        $('#village_id').empty();
                        $('#village_id').append('<option value="">Pilih Desa</option>');
                        $.each(data, function(key, value) {
                            $('#village_id').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            }else{
                $('#village_id').empty();
                $('#village_id').append('<option value="">Pilih Desa</option>');
            }
        });

        $('#birth_date').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush
