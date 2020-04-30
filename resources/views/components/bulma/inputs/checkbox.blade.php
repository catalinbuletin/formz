@foreach($field->getOptions() as $option)
    <label class="checkbox">
        <input class="{{ $inputClass }}"
               type="checkbox"
               name="{{ $field->getName() }}[]"
               id="{{ $field->getName() . '-' . $option['value'] }}"
               value="{{ $option['value'] }}"
                {{ in_array((string) $option['value'], $request->old($field->getName(), $field->getValue())) ? "checked" : "" }}
        >
        {{ $option['label'] }}
    </label>
@endforeach
