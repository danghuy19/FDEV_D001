{!! Form::open(array('route' => 'savecreatesach', 'class' => 'register_form', 'files'=>true)) !!}

    {!! Form::text('ten_sach', null, ['class' => 'form-control']) !!}

    {!! Form::file('ds_hinh[]', ["multiple" => true]) !!}

    {!! Form::submit('Lưu sách', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}