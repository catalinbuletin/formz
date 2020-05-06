<input
        type="text"
        class="{{ $inputClass }}"
        name="{{ $field->getName() }}"
        id="{{ $field->getId() }}"
        value="{{ $request->old($field->getName(), $field->getValue()) }}"
        placeholder="{{ $attributes->get('placeholder') }}"
        {{ $field->getTabindex() ? 'tabindex='.$field->getTabindex() : '' }}
>
