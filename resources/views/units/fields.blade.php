<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>

<!-- Katalog Tanaman Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('katalog_tanaman_id', 'Katalog Tanaman Id:') !!}
    {!! Form::number('katalog_tanaman_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('units.index') !!}" class="btn btn-default">Cancel</a>
</div>
