<div class="formz-section {{ $themeConfig['section_class'] }}">
    @if($section->getLabel())
        <div class="col-xs-12">
            <h4>{{ $section->getLabel() }}</h4>
            <small class="form-text text-muted mb-3">{!! $section->getHelpText() !!}</small>
        </div>
    @endif

    @foreach($fields as $field)
        <x-formz-field :field="$field"></x-formz-field>
    @endforeach
</div>
