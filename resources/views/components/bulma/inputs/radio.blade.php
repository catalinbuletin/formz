@foreach($field->getOptions() as $option)
    <label class="radio">
        <input class="{{ $inputClass }}"
               type="radio"
               name="{{ $field->getName() }}"
               id="{{ $field->getName() . '-' . $option['value'] }}"
               value="{{ $option['value'] }}"
                {{ $request->old($field->getName(), (string)$field->getValue()) === (string)$option['value'] ? "checked" : "" }}
        >
        {{ $option['label'] }}
    </label>
@endforeach
