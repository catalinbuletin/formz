<input
        type="text"
        class="{{ $field->getAttributes()->get('input.class') }}"
        name="{{ $field->getName() }}"
        id="{{ $field->getAttributes()->get('input.id') }}"
        value="{{ $request->old($field->getName(), $field->getValue()) }}"
        placeholder="{{ $field->getAttributes()->get('placeholder') }}"
        {{ $field->getTabindex() ? 'tabindex='.$field->getTabindex() : '' }}
>
