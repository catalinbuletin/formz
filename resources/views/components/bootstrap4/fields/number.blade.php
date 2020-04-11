<div class="col-md-12">

    <x-formz-label :field="$field"></x-formz-label>

    <input
        type="number"
        class="{{ $attributes->get('class') }} {{ $hasErrors ? 'is-invalid' : '' }}"
        name="{{ $field->getName() }}"
        id="{{ $field->getId() }}"
        value="{{ $field->getValue() }}"
        placeholder="{{ $attributes->get('placeholder') }}"
        min="{{ $attributes->get('min') }}"
        max="{{ $attributes->get('max') }}"
        step="{{ $attributes->get('step') }}"
    >

    @if ($hasErrors)
        <x-formz-error :field="$field" :errors="$errors"></x-formz-error>
    @endif
</div>
