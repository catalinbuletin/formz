<input
        type="date"
        class="{{ $field->getAttributes()->get('input.class') }}"
        name="{{ $field->getName() }}"
        id="{{ $field->getAttributes()->get('input.id') }}"
        value="{{ $request->old($field->getName(), $field->getValue()) }}"
        placeholder="{{ $field->getAttributes()->get('placeholder') }}"
        min="{{ Carbon\Carbon::parse($field->getAttributes()->get('min'))->format('Y-m-d') }}"
        max="{{ Carbon\Carbon::parse($field->getAttributes()->get('max'))->format('Y-m-d') }}"
        {{ $field->getTabindex() ? 'tabindex='.$field->getTabindex() : '' }}
>
