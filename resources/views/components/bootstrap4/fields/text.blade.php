<div class="{{ $attributes->get('container.class') }}">
    <label for="{{ $field->getId() }}">
        {{ $field->getLabel() }}
        @if($isRequired)
            <span class="required">*</span>
        @endif
    </label>

    <input
            type="text"
            class="{{ $attributes->get('class') }}"
            name="{{ $field->getName() }}"
            id="{{ $field->getId() }}"
            value="{{ old($field->getName(), $field->getValue()) }}"
            placeholder="{{ $attributes->get('placeholder') }}"
    >

    <span class="error-message">{{ $errors->first($field->getName()) }}</span>
</div>
