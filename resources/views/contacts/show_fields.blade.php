<!-- Establishment Id Field -->
<div class="col-sm-12">
    {!! Form::label('establishment_id', 'Establishment Id:') !!}
    <p>{{ $contact->establishment_id }}</p>
</div>

<!-- Type Field -->
<div class="col-sm-12">
    {!! Form::label('type', 'Type:') !!}
    <p>{{ $contact->type }}</p>
</div>

<!-- Value Field -->
<div class="col-sm-12">
    {!! Form::label('value', 'Value:') !!}
    <p>{{ $contact->value }}</p>
</div>

