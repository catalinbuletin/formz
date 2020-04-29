<select class="{{ $inputClass }}"
        name="{{ $field->getName() }}"
        id="{{ $field->getId() }}"
>
    @foreach($field->getOptions() as $option)
        <option
                value="{{ $option['value'] }}"
                {{ $request->old($field->getName()) === $option['value'] ? "selected" : "" }}
        >
                {{ $option['label'] }}
        </option>
    @endforeach
</select>