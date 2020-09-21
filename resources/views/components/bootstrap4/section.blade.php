<div class="{{ $section->getAttributes()->get('class') }}"
     id="{{ $section->getAttributes()->get('id') }}"
>
    @if($section->getLabel())
        <div class="col-12">
            <h4 class="formz__section-name">{{ $section->getLabel() }}</h4>
            @if ($section->getHelpText())
                <div class="formz__section-description">{!! $section->getHelpText() !!}</div>
            @endif
        </div>
    @endif

    @foreach($fields as $field)
        <x-formz-field :field="$field"></x-formz-field>
    @endforeach
</div>
