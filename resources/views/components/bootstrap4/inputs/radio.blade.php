@foreach($field->getOptions() as $option)
    <div class="custom-control custom-radio">
        <input class="{{ $inputClass }}"
               type="radio"
               name="{{ $field->getName() }}"
               id="{{ $field->getName() . '-' . $option['value'] }}"
               value="{{ $option['value'] }}"
                {{ $request->old($field->getName(), (string)$field->getValue()) === (string)$option['value'] ? "checked" : "" }}
        >
        <label class="custom-control-label" for="{{ $field->getName() . '-' . $option['value'] }}">
            {{ $option['label'] }}
        </label>
    </div>
@endforeach

