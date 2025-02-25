<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Price Category Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price_category', 'Price Category:') !!}
    {!! Form::text('price_category', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Latitude Field -->
<div class="form-group col-sm-6">
    {!! Form::label('latitude', 'Latitude:') !!}
    {!! Form::number('latitude', null, ['class' => 'form-control']) !!}
</div>

<!-- Longitude Field -->
<div class="form-group col-sm-6">
    {!! Form::label('longitude', 'Longitude:') !!}
    {!! Form::number('longitude', null, ['class' => 'form-control']) !!}
</div>

<!-- Preferred Time From Field -->
<div class="form-group col-sm-6">
    {!! Form::label('preferred_time_from', 'Preferred Time From:') !!}
    {!! Form::text('preferred_time_from', null, ['class' => 'form-control']) !!}
</div>

<!-- Preferred Time To Field -->
<div class="form-group col-sm-6">
    {!! Form::label('preferred_time_to', 'Preferred Time To:') !!}
    {!! Form::text('preferred_time_to', null, ['class' => 'form-control']) !!}
</div>