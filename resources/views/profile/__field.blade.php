<div class="form-group col-sm-6">
    {!! Form::label('photo', 'Photo:') !!}
    {!! Form::file('photo', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {{-- show image --}}
    @if(isset($user->photo))
        <img src="{{ $user->photo }}" alt="{{ $user->full_name }}" class="img-thumbnail" width="200">
    @endif
</div>

<div class="form-group col-sm-6">
    {!! Form::label('full_name', 'Nama Lengkap:') !!}
    {!! Form::text('full_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('phone', 'Nomor Handphone:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('province_id', 'Pilih Provinsi:') !!}
    {!! Form::select('province_id', $provinces, $my_province_id, ['class' => 'form-control custom-select', 'placeholder' => 'Pilih Provinsi']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('city_id', 'Pilih Kota/Kabupaten:') !!}
    {!! Form::select('city_id', $cities, $my_city_id, ['class' => 'form-control custom-select']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('district_id', 'Pilih Kecamatan:') !!}
    {!! Form::select('district_id', $districts, $my_district_id, ['class' => 'form-control custom-select']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('village_id', 'Pilih Desa:') !!}
    {!! Form::select('village_id', $villages, $my_village_id, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Alamat Lengkap:') !!}
    {!! Form::textarea('address', null, ['class' => 'form-control']) !!}
</div>

@push('page_scripts')
<script>
    const province = $('#province_id');
    const city = $('#city_id');
    const district = $('#district_id');
    const village = $('#village_id');

    // on change province
    $('#province_id').on('change', function() {
            city.empty();
            district.empty();
            village.empty();

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
            district.empty();
            village.empty();

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
            village.empty();

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
</script>
@endpush
