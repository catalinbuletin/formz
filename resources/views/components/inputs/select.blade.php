<select class="{{ $field->getAttributes()->get('input.class') }}"
        name="{{ $field->getName() }}"
        id="{{ $field->getAttributes()->get('input.id') }}"
        {{ $field->getTabindex() ? 'tabindex='.$field->getTabindex() : '' }}
        >
    @foreach($field->getOptions() as $option)
        <option
                value="{{ $option->getValue() }}"
                {{ $request->old($field->getName(), (string)$field->getValue()) === (string)$option->getValue() ? "selected" : "" }}
        >
                {{ $option->getLabel() }}
        </option>
    @endforeach
</select>
