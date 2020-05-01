<select multiple
        class="{{ $inputClass }}"
        name="{{ $field->getName() }}[]"
        id="{{ $field->getId() }}"
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
