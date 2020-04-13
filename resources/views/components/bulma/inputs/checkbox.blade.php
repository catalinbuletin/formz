@foreach($field->getOptions() as $option)
    <label class="checkbox">
        <input class="{{ $inputClass }}"
               type="checkbox"
               name="{{ $field->getName() }}"
               id="{{ $field->getName() . '-' . $option['value'] }}"
               value="{{ $option['value'] }}"
        >
        {{ $option['label'] }}
    </label>
@endforeach
