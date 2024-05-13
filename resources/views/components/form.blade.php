<form method="{{ $method == 'GET' ? 'GET' : 'POST' }}" action="{{ $action }}">
    @csrf
    @method($method)
    {{ $slot }}
</form>
