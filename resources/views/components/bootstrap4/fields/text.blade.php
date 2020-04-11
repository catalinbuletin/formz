<div class="{{ $wrapperClass }}">
    <x-formz-label :field="$field"></x-formz-label>

    <input
            type="text"
            class="{{ $inputClass }} {{ $hasErrors ? 'is-invalid' : '' }}"
            name="{{ $field->getName() }}"
            id="{{ $field->getId() }}"
            value="{{ old($field->getName(), $field->getValue()) }}"
            placeholder="{{ $attributes->get('placeholder') }}"
    >

    @if ($hasErrors)
        <x-formz-error :field="$field" :errors="$errors"></x-formz-error>
    @endif
</div>
