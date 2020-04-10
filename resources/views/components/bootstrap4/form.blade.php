<form action="{{ $action }}" method="{{ $method }}">

    {{ $header }}

    @csrf

    @if ($method === 'put')
        @method('PUT')
    @elseif ($method === 'patch')
        @method('PATCH')
    @elseif ($method === 'delete')
        @method('DELETE')
    @endif

    @foreach($form->getSections() as $section)
        <x-formz-section :section="$section"></x-formz-section>
    @endforeach

    {{ $footer }}

</form>
