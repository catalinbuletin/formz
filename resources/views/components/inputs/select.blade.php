<select class="{{ $inputClass }}"
        name="{{ $field->getName() }}"
        id="{{ $field->getId() }}"
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
