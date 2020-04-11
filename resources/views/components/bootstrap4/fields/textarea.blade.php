<div class="col-md-12">

    <x-formz-label :field="$field"></x-formz-label>

    <textarea
        class="{{ $attributes->get('class') }} {{ $hasErrors ? 'is-invalid' : '' }}"
        name="{{ $field->getName() }}"
        id="{{ $field->getId() }}"
        placeholder="{{ $attributes->get('placeholder') }}"
    >{{ $field->getValue() }}</textarea>

    @if ($hasErrors)
        <x-formz-error :field="$field" :errors="$errors"></x-formz-error>
    @endif
</div>
