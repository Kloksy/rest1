<!-- User Name Field -->
<div class="col-sm-12">
    {!! Form::label('user_name', 'User Name:') !!}
    <p>{{ $yandexReview->user_name }}</p>
</div>

<!-- Establishment Id Field -->
<div class="col-sm-12">
    {!! Form::label('establishment_id', 'Establishment Id:') !!}
    <p>{{ $yandexReview->establishment_id }}</p>
</div>

<!-- Content Field -->
<div class="col-sm-12">
    {!! Form::label('content', 'Content:') !!}
    <p>{{ $yandexReview->content }}</p>
</div>

<!-- Rating Field -->
<div class="col-sm-12">
    {!! Form::label('rating', 'Rating:') !!}
    <p>{{ $yandexReview->rating }}</p>
</div>

