<div class="col-md-12">

    <x-formz-label :label="$field->getLabel()"
                    :for-id="$field->getId()"
                    :is-required="$isRequired"></x-formz-label>

    <textarea
        class="{{ $attributes->get('class') }} {{ $hasErrors ? 'is-invalid' : '' }}"
        name="{{ $field->getName() }}"
        id="{{ $field->getId() }}"
        placeholder="{{ $attributes->get('placeholder') }}"
    >{{ $field->getValue() }}</textarea>

    @if ($hasErrors)
        <x-formz-error :errors="$errors"></x-formz-error>
    @endif
</div>
