Danh sách sản phẩm
<form action="/test-match" method="POST">
    @csrf
    <!-- Equivalent for @csrf directive -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="text" name="test_value" id="input" class="form-control" value="" >
    <button type="submit">Send Test</button>
    
</form>