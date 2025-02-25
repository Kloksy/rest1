<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $userReview->user_id }}</p>
</div>

<!-- Establishment Id Field -->
<div class="col-sm-12">
    {!! Form::label('establishment_id', 'Establishment Id:') !!}
    <p>{{ $userReview->establishment_id }}</p>
</div>

<!-- Content Field -->
<div class="col-sm-12">
    {!! Form::label('content', 'Content:') !!}
    <p>{{ $userReview->content }}</p>
</div>

<!-- Rating Field -->
<div class="col-sm-12">
    {!! Form::label('rating', 'Rating:') !!}
    <p>{{ $userReview->rating }}</p>
</div>

