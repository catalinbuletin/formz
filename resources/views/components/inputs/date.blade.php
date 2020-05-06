<input
        type="date"
        class="{{ $inputClass }}"
        name="{{ $field->getName() }}"
        id="{{ $field->getId() }}"
        value="{{ $request->old($field->getName(), $field->getValue()) }}"
        placeholder="{{ $attributes->get('placeholder') }}"
        min="{{ Carbon\Carbon::parse($attributes->get('min'))->format('Y-m-d') }}"
        max="{{ Carbon\Carbon::parse($attributes->get('max'))->format('Y-m-d') }}"
        {{ $field->getTabindex() ? 'tabindex='.$field->getTabindex() : '' }}
>
