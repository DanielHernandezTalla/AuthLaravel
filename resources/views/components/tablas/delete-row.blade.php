<form class="p-0" action="{{ route($route, $id) }}" method="POST">
    @csrf
    @method('DELETE')
    @isset($values)
        @foreach ($values as $value)
            <input type="hidden" name="{{ array_key_first($value) }}" value="{{ $value[array_key_first($value)] }}">
        @endforeach
    @endisset
    <button class="btn p-0 m-0"><i class="bi bi-trash text-danger"></i></button>
</form>
