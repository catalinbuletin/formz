<div class="formz-section {{ $sectionClass }}">
    @if($section->getLabel())
        <div class="column is-12">
            <div class="formz__section-name">{{ $section->getLabel() }}</div>
        </div>
    @endif

    @foreach($fields as $field)
        <x-formz-field :field="$field"></x-formz-field>
    @endforeach
</div>
