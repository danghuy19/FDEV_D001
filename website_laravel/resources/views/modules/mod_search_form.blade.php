<div class="container">
    {!! Form::open(['route' => 'search_page', 'class' => 'form-search', 'method' => 'GET']) !!}
        <div class="include_input_search">
            {!! Form::text('keyword', (isset($keyword))?$keyword:'', ['class' => 'form-control']) !!}
        </div>
        <div class="include_button_search">
            {!! Form::submit('Search') !!}
        </div>
    {!! Form::close() !!}
</div>