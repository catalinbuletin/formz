<div class="col-md-12">

    <x-formz-label :field="$field"></x-formz-label>

    <input
        type="password"
        class="{{ $attributes->get('class') }} {{ $hasErrors ? 'is-invalid' : '' }}"
        name="{{ $field->getName() }}"
        id="{{ $field->getId() }}"
        value="{{ $field->getValue() }}"
        placeholder="{{ $attributes->get('placeholder') }}"
        minlength="{{ $attributes->get('min') }}"
        maxlength="{{ $attributes->get('max') }}"
    >

    @if ($hasErrors)
        <x-formz-error :field="$field" :errors="$errors"></x-formz-error>
    @endif
</div>
