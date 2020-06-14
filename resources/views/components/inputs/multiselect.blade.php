<select multiple
        class="{{ $field->getAttributes()->get('input.class') }}"
        name="{{ $field->getName() }}[]"
        id="{{ $field->getAttributes()->get('input.id') }}"
        {{ $field->getTabindex() ? 'tabindex='.$field->getTabindex() : '' }}
>
        @foreach($field->getOptions() as $option)
                <option
                        value="{{ $option->getValue() }}"
                        {{ in_array($option->getValue(), $request->old($field->getName(), $field->getValue())) ? "selected" : "" }}
                >
                        {{ $option->getLabel() }}
                </option>
        @endforeach
</select>
