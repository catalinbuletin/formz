<input
        type="file"
        class="{{ $inputClass }}"
        name="{{ $field->getName() }}"
        id="{{ $field->getId() }}"
        value="{{ $field->getValue() }}"
        {{ $field->getTabindex() ? 'tabindex='.$field->getTabindex() : '' }}
>
