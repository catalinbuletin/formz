@foreach($field->getOptions() as $option)
    <div class="form-check">
        <input class="{{ $inputClass }}"
               type="checkbox"
               name="{{ $field->getName() }}[]"
               id="{{ $field->getName() . '-' . $option['value'] }}"
               value="{{ $option['value'] }}"
                {{ in_array($option['value'], $request->old($field->getName(), [])) ? "checked" : "" }}
        >
        <label class="form-check-label" for="{{ $field->getName() . '-' . $option['value'] }}">
            {{ $option['label'] }}
        </label>
    </div>
@endforeach
