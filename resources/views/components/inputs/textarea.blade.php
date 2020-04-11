<textarea
        class="{{ $inputClass }}"
        name="{{ $field->getName() }}"
        id="{{ $field->getId() }}"
        placeholder="{{ $attributes->get('placeholder') }}"
        rows="{{ $attributes->get('rows') }}"
>{{ $request->old($field->getName(), $field->getValue()) }}
</textarea>
