<form action="{{ $action }}" method="{{ $method }}" class="{{ $formClass }}">
    @csrf

    @if (in_array(strtoupper($method), ['PUT', 'PATCH', 'DELETE']))
        @method(strtoupper($method))
    @endif

    <div class="grid-container">
        {{--  Include the header slot  --}}
        {{ $header }}

        {{--  Include the form submit and cancel buttons if footer is not set  --}}
        @if($config['buttons']['active'] && (bool) $header === false)
            @include($buttons)
        @endif


        @foreach($form->getSections() as $section)
            <x-formz-section :section="$section"></x-formz-section>
        @endforeach


        {{--  Include the form submit and cancel buttons if footer is not set  --}}
        @if($config['buttons']['active'] && (bool) $footer === false)
            @include($buttons)
        @endif

        {{--  Include the footer slot  --}}
        {{ $footer }}
    </div>
</form>
