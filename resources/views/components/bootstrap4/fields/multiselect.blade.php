<div class="col-md-12">

    <x-formz-label :label="$field->getLabel()"
                   :for-id="$field->getId()"
                   :is-required="$isRequired"></x-formz-label>

    <select multiple
            class="{{ $attributes->get('class') }} {{ $hasErrors ? 'is-invalid' : '' }}"
            name="{{ $field->getName() }}"
            id="{{ $field->getId() }}">
        @foreach($field->getOptions() as $option)
            <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
        @endforeach
    </select>

    @if ($hasErrors)
        <x-formz-error :errors="$errors"></x-formz-error>
    @endif
</div>
