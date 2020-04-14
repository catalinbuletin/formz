@foreach($field->getOptions() as $option)
    <div class="form-check">
        <input class="{{ $inputClass }}"
               type="radio"
               name="{{ $field->getName() }}"
               id="{{ $field->getName() . '-' . $option['value'] }}"
               value="{{ $option['value'] }}"
               {{ $request->old($field->getName()) === $option['value'] ? "checked" : "" }}
        >
        <label class="form-check-label" for="{{ $field->getName() . '-' . $option['value'] }}">
            {{ $option['label'] }}
        </label>
    </div>
@endforeach

