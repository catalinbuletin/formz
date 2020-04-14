<form action="{{ $action }}" method="{{ $method }}" class="{{ $formClass }}">

    {{ $header }}

    @csrf

    @if ($method === 'put')
        @method('PUT')
    @elseif ($method === 'patch')
        @method('PATCH')
    @elseif ($method === 'delete')
        @method('DELETE')
    @endif

    <div class="grid-container">
        @foreach($form->getSections() as $section)
            <x-formz-section :section="$section"></x-formz-section>
        @endforeach
    </div>

    {{ $footer }}

</form>
