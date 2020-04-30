<div class="select">
    <select class="{{ $inputClass }}"
            name="{{ $field->getName() }}"
            id="{{ $field->getId() }}"
    >
        @foreach($field->getOptions() as $option)
            <option
                    value="{{ $option['value'] }}"
                    {{ $request->old($field->getName(), (string)$field->getValue()) === (string)$option['value'] ? "selected" : "" }}
            >
                    {{ $option['label'] }}
            </option>
        @endforeach
    </select>
</div>
