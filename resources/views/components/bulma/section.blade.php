<div class="{{ $section->getAttributes()->get('class') }}"
     id="{{ $section->getAttributes()->get('id') }}"
>
    @if($section->getLabel())
        <div class="column is-12">
            <h4>
                {{ $section->getLabel() }}
            </h4>
            @if ($section->getHelpText())
                <p class="help">
                    {!! $section->getHelpText() !!}
                </p>
            @endif
        </div>
    @endif

    @foreach($fields as $field)
        <x-formz-field :field="$field"></x-formz-field>
    @endforeach
</div>
