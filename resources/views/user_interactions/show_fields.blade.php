<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $userInteraction->user_id }}</p>
</div>

<!-- Establishment Id Field -->
<div class="col-sm-12">
    {!! Form::label('establishment_id', 'Establishment Id:') !!}
    <p>{{ $userInteraction->establishment_id }}</p>
</div>

<!-- Review Id Field -->
<div class="col-sm-12">
    {!! Form::label('review_id', 'Review Id:') !!}
    <p>{{ $userInteraction->review_id }}</p>
</div>

<!-- Viewed At Field -->
<div class="col-sm-12">
    {!! Form::label('viewed_at', 'Viewed At:') !!}
    <p>{{ $userInteraction->viewed_at }}</p>
</div>

