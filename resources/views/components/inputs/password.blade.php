<input
        type="password"
        class="{{ $inputClass }}"
        name="{{ $field->getName() }}"
        id="{{ $field->getId() }}"
        value="{{ $field->getValue() }}"
        placeholder="{{ $attributes->get('placeholder') }}"
        minlength="{{ $attributes->get('min') }}"
        maxlength="{{ $attributes->get('max') }}"
>
