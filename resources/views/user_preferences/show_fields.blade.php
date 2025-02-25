<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $userPreference->user_id }}</p>
</div>

<!-- Price Category Field -->
<div class="col-sm-12">
    {!! Form::label('price_category', 'Price Category:') !!}
    <p>{{ $userPreference->price_category }}</p>
</div>

<!-- Latitude Field -->
<div class="col-sm-12">
    {!! Form::label('latitude', 'Latitude:') !!}
    <p>{{ $userPreference->latitude }}</p>
</div>

<!-- Longitude Field -->
<div class="col-sm-12">
    {!! Form::label('longitude', 'Longitude:') !!}
    <p>{{ $userPreference->longitude }}</p>
</div>

<!-- Preferred Time From Field -->
<div class="col-sm-12">
    {!! Form::label('preferred_time_from', 'Preferred Time From:') !!}
    <p>{{ $userPreference->preferred_time_from }}</p>
</div>

<!-- Preferred Time To Field -->
<div class="col-sm-12">
    {!! Form::label('preferred_time_to', 'Preferred Time To:') !!}
    <p>{{ $userPreference->preferred_time_to }}</p>
</div>

