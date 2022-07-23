<?php
Form::macro('colorfield', function($name)
{
    return '<input name="'. $name .'" type="color">';
});

// foreach ($errors->all() as $message) {
//     echo $message;
// }

//$errors->first();
?>

<div class="container_mod_dang_ky_form">
    <div class="container">
        <div class="panel panel-success" style="padding: 20px">
            <h2>
                Đăng ký
            </h2>

            @if($errors->first())
            <div class="error_message panel panel-danger">
                <div class="panel-heading">Vui lòng kiểm tra lỗi</div>
                @foreach($errors->all() as $message_error)
                    <div class="panel-body item_message text-danger">{{$message_error}}</div>
                @endforeach
            </div>
            @endif

            {!! Form::open(array('route' => 'savecreatenewaccount', 'class' => 'register_form', 'files'=>true)) !!}
                
                <!-- username -->
                {!! Form::label('username', "Username") !!}
                {!! Form::text('username', null, array("class" => "form-control", "placeholder" => "Username")) !!}

                <!-- password -->
                {!! Form::label('password', "Password") !!}
                {!! Form::password('password', array("class" => "form-control")) !!}

                <!-- password -->
                {!! Form::label('password_confirmation', "Confirmed Password") !!}
                {!! Form::password('password_confirmation', array("class" => "form-control")) !!}

                <!-- Email -->
                {!! Form::label('email', "Email") !!}
                {!! Form::text('email', null, array("class" => "form-control")) !!}

                <!-- Avatar -->
                {!! Form::label('avatar', "Avatar") !!}
                {!! Form::file('avatar', null, array("class" => "form-control")) !!}

                <!-- ngày sinh -->
                {!! Form::label('date_of_birth', 'Date of Birth') !!}
                {!! Form::date('date_of_birth', \Carbon\Carbon::now(), array("class" => "form-control")) !!} 

                <!-- Giới tính -->
                {!! Form::label('sex', 'Sex') !!}
                {!! Form::radio('sex', 1, true, array('id' => 'nu')) !!}
                {!! Form::label('nu', 'Nữ') !!}
                {!! Form::radio('sex', 0, false, array('id' => 'nam')) !!} 
                {!! Form::label('nam', 'Nam') !!}

                {!! Form::colorfield('test') !!}
                <div>
                    {!! Form::submit('Đăng ký',array('class'=>'btn btn-primary')) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>