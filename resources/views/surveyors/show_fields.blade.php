<!-- Card Id Number Field -->
<div class="col-sm-12">
    {!! Form::label('card_id_number', 'Card Id Number:') !!}
    <p>{{ $surveyor->card_id_number }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $surveyor->name }}</p>
</div>

<!-- Photo Field -->
<div class="col-sm-12">
    {!! Form::label('photo', 'Photo:') !!}
    <p>{{ $surveyor->photo }}</p>
</div>

<!-- Birth Place Field -->
<div class="col-sm-12">
    {!! Form::label('birth_place', 'Birth Place:') !!}
    <p>{{ $surveyor->birth_place }}</p>
</div>

<!-- Birth Date Field -->
<div class="col-sm-12">
    {!! Form::label('birth_date', 'Birth Date:') !!}
    <p>{{ $surveyor->birth_date }}</p>
</div>

<!-- Address Field -->
<div class="col-sm-12">
    {!! Form::label('address', 'Address:') !!}
    <p>{{ $surveyor->address }}</p>
</div>

<!-- Village Id Field -->
<div class="col-sm-12">
    {!! Form::label('village_id', 'Village Id:') !!}
    <p>{{ $surveyor->village_id }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $surveyor->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $surveyor->updated_at }}</p>
</div>

