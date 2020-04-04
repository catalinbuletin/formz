<div>
    <div class="section-name">{{ $section->getLabel() }}</div>

    @foreach($fields as $field)
        <x-formz-field :field="$field"></x-formz-field>
    @endforeach

</div>