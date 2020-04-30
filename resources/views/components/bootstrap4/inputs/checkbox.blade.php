@foreach($field->getOptions() as $option)
    <div class="custom-control custom-checkbox">
        <input class="{{ $inputClass }}"
               type="checkbox"
               name="{{ $field->getName() }}[]"
               id="{{ $field->getName() . '-' . $option['value'] }}"
               value="{{ $option['value'] }}"
                {{ in_array((string) $option['value'], $request->old($field->getName(), $field->getValue())) ? "checked" : "" }}
        >
        <label class="custom-control-label" for="{{ $field->getName() . '-' . $option['value'] }}">
            {{ $option['label'] }}
        </label>
    </div>
@endforeach
