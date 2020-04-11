<div class="col-md-12">

    <x-formz-label :field="$field"></x-formz-label>

    <select multiple
            class="{{ $attributes->get('class') }} {{ $hasErrors ? 'is-invalid' : '' }}"
            name="{{ $field->getName() }}"
            id="{{ $field->getId() }}">
        @foreach($field->getOptions() as $option)
            <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
        @endforeach
    </select>

    @if ($hasErrors)
        <x-formz-error :field="$field" :errors="$errors"></x-formz-error>
    @endif
</div>
