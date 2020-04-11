<div class="col-md-12">

    <x-formz-label :label="$field->getLabel()"
                   :for-id="$field->getId()"
                   :is-required="$isRequired"></x-formz-label>

    <input
        type="date"
        class="{{ $attributes->get('class') }} {{ $hasErrors ? 'is-invalid' : '' }}"
        name="{{ $field->getName() }}"
        id="{{ $field->getId() }}"
        value="{{ $field->getValue() }}"
        placeholder="{{ $attributes->get('placeholder') }}"
        min="{{ Carbon\Carbon::parse($attributes->get('min'))->format('Y-m-d') }}"
        max="{{ Carbon\Carbon::parse($attributes->get('max'))->format('Y-m-d') }}"
    >

    @if ($hasErrors)
        <x-formz-error :errors="$errors"></x-formz-error>
    @endif
</div>