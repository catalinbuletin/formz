<div class="formz-section {{ $themeConfig['section_class'] }}">
    @if($section->getLabel())
        <h4 class="small-12 cell">
            {{ $section->getLabel() }}
        </h4>
    @endif

    @if ($section->getHelpText())
        <div class="small-12 cell">
            <p class="help-text">
                {!! $section->getHelpText() !!}
            </p>
        </div>
    @endif

    @foreach($fields as $field)
        <x-formz-field :field="$field"></x-formz-field>
    @endforeach
</div>
