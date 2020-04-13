<div class="select is-multiple">
    <select multiple
            class="{{ $inputClass }}"
            name="{{ $field->getName() }}[]"
            id="{{ $field->getId() }}"
    >
            @foreach($field->getOptions() as $option)
                    <option
                            value="{{ $option['value'] }}"
                            {{ in_array($option['value'], $request->old($field->getName(), $field->getValue())) ? "selected" : "" }}
                    >
                            {{ $option['label'] }}
                    </option>
            @endforeach
    </select>
</div>
