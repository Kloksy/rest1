<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Establishment Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('establishment_id', 'Establishment Id:') !!}
    {!! Form::number('establishment_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Review Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('review_id', 'Review Id:') !!}
    {!! Form::number('review_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Viewed At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('viewed_at', 'Viewed At:') !!}
    {!! Form::text('viewed_at', null, ['class' => 'form-control','id'=>'viewed_at']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#viewed_at').datepicker()
    </script>
@endpush