    <input
        type="number"
        class="{{ $inputClass }}"
        name="{{ $field->getName() }}"
        id="{{ $field->getId() }}"
        value="{{ $request->old($field->getName(), $field->getValue()) }}"
        placeholder="{{ $attributes->get('placeholder') }}"
        min="{{ $attributes->get('min') }}"
        max="{{ $attributes->get('max') }}"
        step="{{ $attributes->get('step') }}"
    >