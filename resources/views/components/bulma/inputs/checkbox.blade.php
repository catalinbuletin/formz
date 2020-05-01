@foreach($field->getOptions() as $option)
    <label class="checkbox">
        <input class="{{ $inputClass }}"
               type="checkbox"
               name="{{ $field->getName() }}[]"
               id="{{ $field->getName() . '-' . $option->getValue() }}"
               value="{{ $option->getValue() }}"
                {{ in_array((string) $option->getValue(), $request->old($field->getName(), $field->getValue())) ? "checked" : "" }}
        >
        {{ $option->getLabel() }}
    </label>
@endforeach
