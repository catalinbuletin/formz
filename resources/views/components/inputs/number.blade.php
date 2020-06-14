    <input
        type="number"
        class="{{ $field->getAttributes()->get('input.class') }}"
        name="{{ $field->getName() }}"
        id="{{ $field->getAttributes()->get('input.id') }}"
        value="{{ $request->old($field->getName(), $field->getValue()) }}"
        placeholder="{{ $field->getAttributes()->get('placeholder') }}"
        min="{{ $field->getAttributes()->get('min') }}"
        max="{{ $field->getAttributes()->get('max') }}"
        step="{{ $field->getAttributes()->get('step') }}"
        {{ $field->getTabindex() ? 'tabindex='.$field->getTabindex() : '' }}
    >
